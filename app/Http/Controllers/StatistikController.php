<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use App\Models\Responden;
use App\Models\Jawaban;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        // 1. Total Responden - jumlah seluruh responden yang pernah mengisi survey
        $totalResponden = Responden::count();

        // 2. Total Survey Aktif - jumlah survey yang statusnya masih aktif
        $totalSurveyAktif = Kuesioner::where(function ($query) {
            // Survei dengan status_manual = true (diaktifkan secara manual)
            $query->where('status_manual', true)
                  // ATAU survei dengan status_manual = null (tidak diatur) DAN logika tanggal menyatakan aktif
                  ->orWhere(function ($subQuery) {
                      $subQuery->whereNull('status_manual')
                              ->where(function ($dateSubQuery) {
                                  $dateSubQuery->where(function ($q) {
                                                      $q->whereNotNull('tanggal_mulai')
                                                        ->whereNotNull('tanggal_selesai')
                                                        ->where('tanggal_mulai', '<=', now())
                                                        ->where('tanggal_selesai', '>=', now());
                                                  })
                                                  ->orWhere(function ($q) {
                                                      $q->whereNull('tanggal_mulai')
                                                        ->whereNull('tanggal_selesai');
                                                  })
                                                  ->orWhere(function ($q) {
                                                      $q->whereNotNull('tanggal_mulai')
                                                        ->whereNull('tanggal_selesai')
                                                        ->where('tanggal_mulai', '<=', now());
                                                  })
                                                  ->orWhere(function ($q) {
                                                      $q->whereNull('tanggal_mulai')
                                                        ->whereNotNull('tanggal_selesai')
                                                        ->where('tanggal_selesai', '>=', now());
                                                  });
                              });
                  });
        })->count();

        // 3. Tingkat Kepuasan Rata-rata - rata-rata nilai persentase kepuasan dari semua survey
        // Kita menghitung rata-rata jawaban yang berupa nilai numerik (1-5) dari pertanyaan yang memiliki jawaban numerik
        $totalJawabanLikert = Jawaban::whereBetween('jawaban', [1, 5])
                                ->avg('jawaban');

        // Konversi nilai rata-rata jawaban menjadi persentase kepuasan (asumsi skala 1-5)
        // Skala 1 = sangat tidak puas (0%), 5 = sangat puas (100%)
        $tingkatKepuasanRata = 0;
        if ($totalJawabanLikert) {
            $tingkatKepuasanRata = round((($totalJawabanLikert - 1) / 4) * 100, 2); // Konversi dari skala 1-5 ke persentase
        }

        // 4. Jumlah Responden Bulan Ini
        $jumlahRespondenBulanIni = Responden::whereMonth('created_at', Carbon::now()->month)
                                          ->whereYear('created_at', Carbon::now()->year)
                                          ->count();

        // 5. Survey Terpopuler Saat Ini - 3 survey yang paling banyak diisi dalam sebulan terakhir
        $surveyTerpopuler = Responden::select('kuesioner.id_kuesioner', 'kuesioner.nama', 'kuesioner.deskripsi', \DB::raw('COUNT(*) as total_responden'))
                                   ->join('kuesioner', 'responden.id_kuesioner', '=', 'kuesioner.id_kuesioner')
                                   ->where('responden.created_at', '>=', Carbon::now()->subMonth())
                                   ->groupBy('kuesioner.id_kuesioner', 'kuesioner.nama', 'kuesioner.deskripsi')
                                   ->orderBy('total_responden', 'desc')
                                   ->limit(3)
                                   ->get();

        return view('landing', compact(
            'totalResponden',
            'totalSurveyAktif',
            'tingkatKepuasanRata',
            'jumlahRespondenBulanIni',
            'surveyTerpopuler'
        ));
    }
}