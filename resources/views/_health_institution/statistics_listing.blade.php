@extends('_health_institution.partials.master')
@section('page_title', 'List all Disease Statistics | e-Demic')
@section('page_heading', 'List all Disease Statistics')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>Disease Code</th>
                                    <th>Disease Name</th>
                                    <th>Infected</th>
                                    <th>Recovered</th>
                                    <th>Dead</th>
                                    <th>Self Quarantine</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diagnosis_logs as $disease_id => $diagnosis_log)
                                    @php
                                        $model = 'App\Models\Disease';
                                        $disease = $model::find($disease_id);

                                        $infected_count = $diagnosis_log->has($model::INFECTION_STATUS) ?
                                                            $diagnosis_log[$model::INFECTION_STATUS]->count() : 0;
                                        $recovered_count = $diagnosis_log->has($model::RECOVERED_STATUS) ?
                                                            $diagnosis_log[$model::RECOVERED_STATUS]->count() : 0;
                                        $dead_count = $diagnosis_log->has($model::DEAD_STATUS) ?
                                                            $diagnosis_log[$model::DEAD_STATUS]->count() : 0;
                                        $self_quarantine_count = $diagnosis_log->has($model::SELF_QUARANTINE_STATUS) ?
                                                            $diagnosis_log[$model::SELF_QUARANTINE_STATUS]->count() : 0;
                                    @endphp
                                    <tr>
                                        <td> {{ $disease->diseaseCode }} </td>
                                        <td> {{ $disease->name }} </td>
                                        <td> {{ $infected_count }} </td>
                                        <td> {{ $recovered_count }} </td>
                                        <td> {{ $dead_count }} </td>
                                        <td> {{ $self_quarantine_count }} </td>
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