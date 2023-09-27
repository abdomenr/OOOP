@extends('admin.admin_master')

@section('admin')
<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white fw-500">
                                Filter and Sorter
                            </div>
                            <div class="card-body p-4">
                                <!-- Filter Form -->
                                <form action="{{ route('nps.calculate') }}" method="get">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="start_date" class="form-label">Start Date:</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date" class="form-label">End Date:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="survey_status" class="form-label">Survey Status:</label>
                                            <select name="survey_status" id="survey_status" class="form-control">
                                                <option value="Yes">---</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="Partial">Partial</option>
                                                <!-- Add more survey status options as needed -->
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="whatsapp_number" class="form-label">WhatsApp Number:</label>
                                            <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="chat_start_datetime" class="form-label">Chat Start Datetime:</label>
                                            <input type="datetime-local" name="chat_start_datetime" id="chat_start_datetime" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="served_by" class="form-label">Served By:</label>
                                            <select name="served_by" id="served_by" class="form-control">
                                                <option value="">Select Served By</option>
                                                <option value="Agent">Agent</option>
                                                <option value="Chatbot">Chatbot</option>
                                                <!-- Add more served by options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                                </form>
                                <!-- End of Filter Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Combined Table for NPS, CES, and CSAT -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white fw-500">
                            Survey Scores
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>NPS</th>
                                            <th>CES</th>
                                            <th>CSAT</th>
                                            <th>Total Surveys</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>NPS%: {{ $nps }}</td>
                                            <td>CES%: {{ $cesScore }}%, Participation Rate: {{ $participationRate }}%</td>
                                            <td>CSAT%: {{ $csatScore }}%, Participation Rate: {{ $participationRate }}%</td>
                                            <td>Participation Rate: {{ $participationRate }}%, Total Surveys: {{ $totalSurveysCSAT }}</td>
                                        </tr>
                                        <tr>
                                            <td>Promoters Percentage %: {{ $promotersPercentage }}%</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Detractors Percentage %: {{ $detractorsPercentage }}%</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Passives Percentage %: {{ $passivesPercentage }}%</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Combined Table -->
            </div>
        </div>
    </div>
</div>
@endsection
