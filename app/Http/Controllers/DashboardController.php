<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Responden;
use App\Models\Kategori;
use App\Models\Admin;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        // Total counts for existing cards
        $totalForms = Kuesioner::count();
        $totalResponden = Responden::count();
        $totalKategori = Kategori::count();
        $totalAdmin = Admin::count();

        // Rata-rata Tingkat Kepuasan
        $satisfactionAverage = $this->calculateSatisfactionAverage();

        // Responden per hari/bulan
        $respondenStats = $this->getRespondenStats();

        // Form yang akan berakhir segera
        $upcomingExpiredForms = $this->getUpcomingExpiredForms();

        // Recent forms for existing table
        $recentForms = Kuesioner::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        return view('Admin.Dashboard.dashboard', compact([
            'currentUser',
            'totalForms',
            'totalResponden',
            'totalKategori',
            'totalAdmin',
            'satisfactionAverage',
            'respondenStats',
            'upcomingExpiredForms',
            'recentForms'
        ]));
    }

    private function calculateSatisfactionAverage()
    {
        // Since we don't know the exact column name for question types in the current schema,
        // we'll use a more generic approach or return 0 if we can't determine rating questions

        // Calculate the average of all numeric answers and convert to percentage
        try {
            $numericAnswers = Jawaban::whereNotNull('jawaban')
                ->whereRaw("CAST(jawaban AS CHAR) REGEXP '^[0-9]+\\.?[0-9]*$'") // Only numeric values
                ->selectRaw('AVG(CAST(jawaban AS DECIMAL(10,2))) as avg_satisfaction')
                ->first();

            $avgSatisfaction = $numericAnswers ? $numericAnswers->avg_satisfaction : 0;

            // Assuming rating scale is out of 5, convert to percentage (e.g., 4 out of 5 = 80%)
            // Or if it's already a percentage scale, return as is
            if ($avgSatisfaction > 0) {
                // We'll assume the max possible rating is 5 for common rating systems
                // Convert to percentage: (average / max_possible) * 100
                $maxPossibleRating = 5; // Adjust this based on your actual rating scale
                $percentage = min(100, ($avgSatisfaction / $maxPossibleRating) * 100); // Cap at 100%
                return round($percentage, 2);
            }
            return 0;
        } catch (\Exception $e) {
            // If there's an error (like missing column), return 0 as fallback
            return 0;
        }
    }

    private function getRespondenStats()
    {
        // Get last 30 days data for daily chart
        $dailyData = Responden::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Get last 12 months data for monthly chart
        $monthlyData = Responden::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('month')
            ->get();

        return [
            'daily' => $dailyData,
            'monthly' => $monthlyData
        ];
    }

    private function getUpcomingExpiredForms()
    {
        // Get forms that will expire in the next 7 days
        $nextWeek = Carbon::now()->addDays(7);

        return Kuesioner::whereNotNull('tanggal_selesai')
            ->where('tanggal_selesai', '<=', $nextWeek)
            ->where('tanggal_selesai', '>=', Carbon::now())
            ->orderBy('tanggal_selesai', 'asc')
            ->take(5)
            ->get();
    }
}
