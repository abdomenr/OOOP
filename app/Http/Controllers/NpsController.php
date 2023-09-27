<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LimeSurvey689126;
use Carbon\Carbon;

class NpsController extends Controller
{
    public function calculateNPS(Request $request)
    {
        $surveyStatus = $request->input('survey_status');
        $whatsappNumber = $request->input('whatsapp_number');
        $chatStartDatetime = $request->input('chat_start_datetime');
        $servedBy = $request->input('served_by');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = LimeSurvey689126::query();

        if ($surveyStatus) {
            $query->where('survey_submitted_status', $surveyStatus);
        }

        if ($whatsappNumber) {
            $query->where('whatsapp_number', $whatsappNumber);
        }

        if ($chatStartDatetime) {
            $query->where('chat_start_datetime', $chatStartDatetime);
        }

        if ($servedBy) {
            $query->where(function ($query) use ($servedBy) {
                if ($servedBy === 'Agent') {
                    $query->orWhere('Served_By', 'Agent');
                }
                if ($servedBy === 'Chatbot') {
                    $query->orWhere('Served_By', 'Chatbot');
                }
            });
        }

        if ($startDate && $endDate) {
            $query->whereBetween('submitdate', [$startDate, $endDate]);
        }

        $surveyData = $query->get();

        $promoters = 0;
        $detractors = 0;
        $passives = 0;
        $satisfiedCustomersCES = 0;
        $totalResponsesCES = 0;
        $satisfiedCustomersCSAT = 0;
        $totalSurveysCSAT = 0;

        foreach ($surveyData as $response) {
            $score = $response->{'689126X1X3'};

            if ($score >= 9 && $score <= 10) {
                $promoters++;
            } elseif ($score >= 0 && $score <= 6) {
                $detractors++;
            } elseif ($score == 7 || $score == 8) {
                $passives++;
            }

            $satisfactionCES = $response->{'689126X1X2'};

            if ($satisfactionCES == 4 || $satisfactionCES == 5) {
                $satisfiedCustomersCES++;
            }

            $totalResponsesCES++;

            $csat = $response->{'689126X1X1'};

            if ($csat >= 1 && $csat <= 5) {
                $satisfiedCustomersCSAT++;
                $totalSurveysCSAT++;
            }
        }

        $totalSurveys = count($surveyData);
        $promotersPercentage = ($totalSurveys > 0) ? ($promoters / $totalSurveys) * 100 : 0;
        $detractorsPercentage = ($totalSurveys > 0) ? ($detractors / $totalSurveys) * 100 : 0;
        $passivesPercentage = ($totalSurveys > 0) ? ($passives / $totalSurveys) * 100 : 0;
        $cesScore = ($totalResponsesCES > 0) ? ($satisfiedCustomersCES / $totalResponsesCES) * 100 : 0;
        $csatScore = ($totalSurveysCSAT > 0) ? ($satisfiedCustomersCSAT / $totalSurveysCSAT) * 100 : 0;

        $nps = $promotersPercentage - $detractorsPercentage;

        $participationRate = 0;

        if ($surveyStatus) {
            $participationCount = $query->count();
            $totalSentSurveys = LimeSurvey689126::count();
            $participationRate = ($totalSentSurveys > 0) ? ($participationCount / $totalSentSurveys) * 100 : 0;
        }

        return view('nps', compact('nps', 'promoters', 'detractors', 'passives', 'promotersPercentage', 'detractorsPercentage', 'passivesPercentage', 'cesScore', 'satisfiedCustomersCES', 'totalResponsesCES', 'csatScore', 'satisfiedCustomersCSAT', 'totalSurveysCSAT', 'participationRate'));
    }
}
