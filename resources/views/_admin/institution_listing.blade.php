@extends('_admin.partials.master')
@section('page_title', 'List all Health Institutions | e-Demic')
@section('page_heading', 'List all Health Institutions')

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
                                    <th>Health Institution</th>
                                    <th>Email ID</th>
                                    <th>Parent Health Head</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($health_institutions as $health_institution)
                                    <tr>
                                        <td> {{ $health_institution->name }}</td>
                                        <td> {{ $health_institution->email }} </td>
                                        <td> {{ $health_institution->health_institution_profile->health_head->name }}</td>
                                        <td>
                                            @if($health_institution->isActive == 1)
                                                <a href="{{ route('admin_health_institutions.toggleStatus', $health_institution->uuid ) }}" class="btn btn-icon btn btn-warning btn-sm"> <i class="la la-ban"></i> Deactivate </a>
                                            @else
                                                <a href="{{ route('admin_health_institutions.toggleStatus', $health_institution->uuid ) }}" class="btn btn-icon btn btn-success btn-sm"> <i class="la la-check-circle"></i> Activate </a>
                                            @endif
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