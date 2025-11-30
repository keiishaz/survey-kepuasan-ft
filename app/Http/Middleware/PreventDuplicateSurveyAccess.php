<?php

namespace App\Http\Middleware;

use App\Models\Kuesioner;
use App\Models\Responden;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateSurveyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $surveyId = $request->route('id');

        // Check if the survey exists
        $survey = Kuesioner::find($surveyId);
        if (!$survey) {
            abort(404, 'Survey tidak ditemukan.');
        }

        // Check if the user has already completed this specific survey in their session
        $completedSurveys = Session::get('completed_surveys', []);

        if (in_array($surveyId, $completedSurveys)) {
            // If this survey has already been completed by this user, redirect to thank you page
            return redirect()->route('isi-survey.selesai', ['id' => $surveyId]);
        }

        // Check for existing completed responses for this survey based on multiple criteria
        $existingResponse = null;

        // Use session ID as fingerprint for this request
        $fingerprint = $request->session()->getId();

        // Build a query to check for existing responses with matching fingerprint or identity values
        $existingQuery = Responden::where('id_kuesioner', $surveyId)
                                  ->whereNotNull('waktu_submit'); // Only count submitted responses

        // First check by fingerprint (session-based detection)
        $existingResponse = $existingQuery->where('fingerprint', $fingerprint)->first();

        if (!$existingResponse) {
            // If no match found by fingerprint, check by identity values
            $identityConditions = [];

            // Collect identity values from the request
            if ($request->filled('identitas1')) {
                $identityConditions['identitas1'] = $request->input('identitas1');
            }
            if ($request->filled('identitas2')) {
                $identityConditions['identitas2'] = $request->input('identitas2');
            }
            if ($request->filled('identitas3')) {
                $identityConditions['identitas3'] = $request->input('identitas3');
            }
            if ($request->filled('identitas4')) {
                $identityConditions['identitas4'] = $request->input('identitas4');
            }
            if ($request->filled('identitas5')) {
                $identityConditions['identitas5'] = $request->input('identitas5');
            }

            if (!empty($identityConditions)) {
                // Check if any of the provided identity values match existing responses
                foreach ($identityConditions as $field => $value) {
                    $existingResponse = $existingQuery->where($field, $value)->first();
                    if ($existingResponse) {
                        break; // Found a match
                    }
                }
            }
        }

        // If we're accessing the get route and there's already a completed response, redirect to thank you page
        if ($request->isMethod('get') && $existingResponse) {
            // Mark this survey as completed in session to prevent future access
            $completedSurveys[] = $surveyId;
            Session::put('completed_surveys', array_unique($completedSurveys));

            // Redirect to thank you page
            return redirect()->route('isi-survey.selesai', ['id' => $surveyId]);
        }

        return $next($request);
    }
}
