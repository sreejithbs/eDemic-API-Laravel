@extends('_health_institution.partials.master')
@section('page_title', 'View Patient Details | e-Demic')
@section('page_heading', 'View Patient Details')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Patient Location Logs</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <span class="badge">
                            <a href="{{ route('institution_patients.list') }}" class="btn btn-sm btn-secondary">
                                <i class="ft-arrow-left"></i> Back to Listing Page
                            </a>
                        </span>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered table-responsive dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Reported Location</th>
                                    <th>Reported Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($location_logs = $diagnosis_log->user_location_logs()->latest('id')->get())
                                @foreach($location_logs as $location_log)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $location_log->latitude }} </td>
                                        <td> {{ $location_log->longitude }} </td>
                                        <td> {{ $location_log->address }} </td>
                                        <td> {{ $location_log->date_time_formatted }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection