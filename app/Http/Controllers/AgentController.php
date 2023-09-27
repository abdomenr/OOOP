<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LimeSurvey689126; // Import the LimeSurvey689126 model

class AgentController extends Controller
{
    public function calculateNPS(Request $request)
    {
        // Get the input criteria from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $surveyStatus = $request->input('survey_status');
        $whatsappNumber = $request->input('whatsapp_number');
        $chatStartDatetime = $request->input('chat_start_datetime');
        $servedBy = $request->input('served_by');
        $interval = $request->input('interval'); // New input for the selected interval

        // Start with a base query to retrieve all records
        $query = LimeSurvey689126::query();

        // Select the necessary fields for grouping (e.g., submitdate, Agent name)
        $query->select('submitdate', 'agent_name'); // Replace 'submitdate' and 'agent_name' with actual field names

        // Conditionally apply filters if values are provided in the request
        if ($startDate && $endDate) {
            $query->whereBetween('submitdate', [$startDate, $endDate]);
        }

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
            if ($servedBy === 'Agent') {
                $query->where('Served_By', 'Agent');
            } elseif ($servedBy === 'Chatbot') {
                $query->where('Served_By', 'Chatbot');
            }
        }

        // Apply grouping based on the selected interval
        switch ($interval) {
            case 'hourly':
                $query->groupBy(\DB::raw('DATE_FORMAT(submitdate, "%Y-%m-%d %H:00:00")'));
                break;
            case 'daily':
                $query->groupBy(\DB::raw('DATE(submitdate)'));
                break;
            case 'weekly':
                $query->groupBy(\DB::raw('YEARWEEK(submitdate)'));
                break;
            case 'monthly':
                $query->groupBy(\DB::raw('DATE_FORMAT(submitdate, "%Y-%m")'));
                break;
            case 'quarterly':
                $query->groupBy(\DB::raw('CONCAT(YEAR(submitdate), " Q", QUARTER(submitdate))'));
                break;
            default:
                // No grouping by default
                break;
        }

        // Retrieve the filtered survey data with grouping
        $surveyData = $query->get();

        // Initialize an array to store agent data
        $agentData = [];

        // Loop through the survey data to calculate metrics for each Agent
        foreach ($surveyData as $response) {
            $agentName = $response->agent_name; // Replace 'agent_name' with the actual field name
            // Calculate CES, CSAT, and NPS scores for each response (similar to your previous logic)
            // ...

            // Store the metrics in the agentData array
            if (!isset($agentData[$agentName])) {
                $agentData[$agentName] = [
                    'agent_name' => $agentName,
                    'ces_score' => 0,
                    'csat_score' => 0,
                    'nps_score' => 0,
                ];
            }

            // Update the scores for the Agent
            // ...

            // You may want to calculate counts and percentages as well
            // ...

            // Example update:
            $agentData[$agentName]['ces_score'] += $cesScore;
            $agentData[$agentName]['csat_score'] += $csatScore;
            $agentData[$agentName]['nps_score'] += $nps;
        }

        // Initialize counters for NPS, CES, and CSAT (retain the previous code here)
        $promoters = 0;
        $detractors = 0;
        $passives = 0;
        $satisfiedCustomersCES = 0;
        $totalResponsesCES = 0;
        $satisfiedCustomersCSAT = 0;
        $totalSurveysCSAT = 0;

        // Calculate Promoters, Detractors, and Passives for NPS (retain the previous code here)
        foreach ($surveyData as $response) {
            $score = $response->{'689126X1X3'};

            if ($score >= 9 && $score <= 10) {
                $promoters++;
            } elseif ($score >= 0 && $score <= 6) {
                $detractors++;
            } elseif ($score == 7 || $score == 8) {
                $passives++;
            }
        }

        // Calculate CES Score and CSAT within the same loop (retain the previous code here)
        foreach ($surveyData as $response) {
            // Assuming the satisfaction question for CES is stored in a field called '689126X1X2'
            $satisfactionCES = $response->{'689126X1X2'};

            // Check if the response indicates satisfaction for CES (answers 4 or 5)
            if ($satisfactionCES == 4 || $satisfactionCES == 5) {
                $satisfiedCustomersCES++;
            }

            // Increment the total responses counter for CES
            $totalResponsesCES++;

            // Assuming the CSAT question is stored in a field called '689126X1X1'
            $csat = $response->{'689126X1X1'};

            // Check if the response indicates satisfaction for CSAT (within the range 1-5)
            if ($csat >= 1 && $csat <= 5) {
                $satisfiedCustomersCSAT++;
                $totalSurveysCSAT++;
            }
        }

        // Calculate percentages for NPS, CES, and CSAT (retain the previous code here)
        $totalSurveys = count($surveyData);
        $promotersPercentage = ($totalSurveys > 0) ? ($promoters / $totalSurveys) * 100 : 0;
        $detractorsPercentage = ($totalSurveys > 0) ? ($detractors / $totalSurveys) * 100 : 0;
        $passivesPercentage = ($totalSurveys > 0) ? ($passives / $totalSurveys) * 100 : 0;
        $cesScore = ($totalResponsesCES > 0) ? ($satisfiedCustomersCES / $totalResponsesCES) * 100 : 0;
        $csatScore = ($totalSurveysCSAT > 0) ? ($satisfiedCustomersCSAT / $totalSurveysCSAT) * 100 : 0;

        // Calculate NPS (retain the previous code here)
        $nps = $promotersPercentage - $detractorsPercentage;

        $participationRate = 0; // Initialize the participation rate

        if ($surveyStatus) {
            // Count the number of records matching the filter criteria
            $participationCount = $query->count();

            // Calculate the total number of sent surveys (you may need to adjust this based on your data model)
            $totalSentSurveys = LimeSurvey689126::count();

            // Calculate the participation rate percentage
            $participationRate = ($totalSentSurveys > 0) ? ($participationCount / $totalSentSurveys) * 100 : 0;
        }

        // Pass the participation rate, other data, and agent-specific metrics data to the view
        return view('Agent', [
            'nps' => $nps,
            'promoters' => $promoters,
            'detractors' => $detractors,
            'passives' => $passives,
            'promotersPercentage' => $promotersPercentage,
            'detractorsPercentage' => $detractorsPercentage,
            'passivesPercentage' => $passivesPercentage,
            'cesScore' => $cesScore,
            'satisfiedCustomersCES' => $satisfiedCustomersCES,
            'totalResponsesCES' => $totalResponsesCES,
            'csatScore' => $csatScore,
            'satisfiedCustomersCSAT' => $satisfiedCustomersCSAT,
            'totalSurveysCSAT' => $totalSurveysCSAT,
            'participationRate' => $participationRate,
            'surveyData' => $agentData, // Pass the agent-specific metrics data to the view
        ]);
    }
}
