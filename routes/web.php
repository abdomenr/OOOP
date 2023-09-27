<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LimeSurvey689126Controller;
use App\Http\Controllers\NpsController;
use App\Http\Controllers\AgentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route for displaying the filter form and results
Route::get('/filter-survey', [LimeSurvey689126Controller::class, 'LimeSurveyAll'])->name('filter_survey');

// Route for exporting filtered data
Route::get('/filter-survey/export', [LimeSurvey689126Controller::class, 'export'])->name('filter_survey.export');

Route::get('/lime-survey/all', [LimeSurvey689126Controller::class, 'LimeSurveyAll'])->name('lime-survey.all');
Route::get('/nps', [NpsController::class, 'calculateNPS'])->name('nps.calculate');

Route::get('/agent', [AgentController::class, 'calculateNPS'])->name('agent.calculateNPS');
