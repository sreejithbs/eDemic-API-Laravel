@extends('_health_institution.partials.master')
@section('page_title', 'List all Self Quarantine Users | e-Demic')
@section('page_heading', 'List all Self Quarantine Users')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered table-responsive dtTable">
                            <thead>
                                <tr>
                                    <th rowspan="2">User Code</th>
                                    <th rowspan="2">Quarantine Location</th>
                                    <th colspan="2">Last Reported</th>
                                    <th rowspan="2">Phone Number</th>
                                    <th rowspan="2">Disease</th>
                                    <th rowspan="2">Actions</th>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diagnosis_logs as $diagnosis_log)
                                    <tr>
                                        <td> {{ $diagnosis_log->user->userCode }} </td>
                                        <td>
                                            @if($quarantine = $diagnosis_log->user->quarantine)
                                                {{ $quarantine->address }}
                                            @else
                                                -- Not Available --
                                            @endif
                                        </td>
                                        <td> {{ $diagnosis_log->user_location_logs()->latest('id')->first()->address }} </td>
                                        <td> {{ $diagnosis_log->user_location_logs()->latest('id')->first()->date_time_formatted }} </td>
                                        <td> {{ $diagnosis_log->user->phone }} </td>
                                        <td> {{ $diagnosis_log->disease->name }} </td>
                                        <td>
                                            <a href="{{ route('institution_quarantine.showQuarantine', $diagnosis_log->uuid ) }}" class="btn btn-icon btn-info btn-sm"> <i class="la la-eye"></i> </a>
                                        </td>
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