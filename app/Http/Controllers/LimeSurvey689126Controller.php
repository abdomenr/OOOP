<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Exports\LimeSurvey689126Export;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LimeSurvey689126;
use Illuminate\Http\Request;


class LimeSurvey689126Controller extends Controller
{

        public function LimeSurveyAll(Request $request)
        {
            // Get the input criteria from the request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $surveyStatus = $request->input('survey_status');
            $whatsappNumber = $request->input('whatsapp_number');
            $chatStartDatetime = $request->input('chat_start_datetime');
            $servedBy = $request->input('served_by');
    
            // Start with a base query to retrieve all records
            $query = LimeSurvey689126::query();
    
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
    
            // Retrieve the filtered data
            $filteredData = $query->latest()->get();
    
            // Pass the filtered data to the view
            return view('backend.LimeSurvey.LimeSurvey_all', compact('filteredData'));
        }
    
        public function export(Request $request)
        {
            // Retrieve the filtered data again using the same filtering logic
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $surveyStatus = $request->input('survey_status');
            $whatsappNumber = $request->input('whatsapp_number');
            $chatStartDatetime = $request->input('chat_start_datetime');
            $servedBy = $request->input('served_by');
    
            // Start with a base query to retrieve all records
            $query = LimeSurvey689126::query();
    
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
    
            // Retrieve the filtered data
            $filteredData = $query->latest()->get();
    
            // Export the filtered data to Excel
            return Excel::download(new LimeSurvey689126Export($filteredData), 'filtered_lime_survey_data.xlsx');
        }
    }
