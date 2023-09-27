@extends('admin.admin_master')

@section('admin')
<div class="contents">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <div class="col-lg-12 mb-30">
                        <div class="card">
                            <div class="card-header bg-primary text-white fw-500">
                                Filter and Sorter
                            </div>
                            <div class="card-body p-0">
                                <!-- Horizontal Form -->
                                <form action="{{ route('filter_survey') }}" method="GET" class="form-horizontal p-3">
                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                        <div class="col-sm-4">
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="survey_status" class="col-sm-2 col-form-label">Survey Status</label>
                                        <div class="col-sm-4">
                                            <select name="survey_status" class="form-control">
                                                <option value="">---</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                                <option value="Partial">Partial</option>
                                            </select>
                                        </div>
                                        <label for="whatsapp_number" class="col-sm-2 col-form-label">WhatsApp Number</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="whatsapp_number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="chat_start_datetime" class="col-sm-2 col-form-label">Chat Start Datetime</label>
                                        <div class="col-sm-4">
                                            <input type="datetime-local" name="chat_start_datetime" class="form-control">
                                        </div>
                                        <label for="served_by" class="col-sm-2 col-form-label">Served By</label>
                                        <div class="col-sm-4">
                                            <select name="served_by" class="form-control">
                                                <option value="">All</option>
                                                <option value="Agent">Agent</option>
                                                <option value="Chatbot">Chatbot</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="reset" class="btn btn-secondary" id="resetFilter">Reset</button>
                                            <a href="{{ route('filter_survey.export') }}" class="btn btn-success">Export Filtered Data</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- End of Horizontal Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Your table code remains unchanged -->
                <div class="col-lg-12 mb-30">
                    <div class="card">
                        <div class="card-header bg-primary text-white fw-500">
                            Filtered Data
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <!-- Add table headers for all fields from your model -->
                                            <th>#</th>
                                            <th>Survey submitted date & Time</th>
                                            <th>Survey Sent date & Time</th>
                                            <th>Survey Submitted Status</th>
                                            <th>CSAT</th>
                                            <th>CES</th>
                                            <th>NPS</th>
                                            <th>Open question</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($filteredData as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->submitdate }}</td>
                                            <td>{{ $item->survey_sent_date }}</td>
                                            <td>{{ $item->survey_submitted_status }}</td>
                                            <td>{{ $item->{'689126X1X1'} }}</td>
                                            <td>{{ $item->{'689126X1X2'} }}</td>
                                            <td>{{ $item->{'689126X1X3'} }}</td>
                                            <td>{{ $item->{'689126X1X4'} }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 2
@endsection
