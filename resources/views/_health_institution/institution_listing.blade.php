@extends('_health_institution.partials.master')
@section('page_title', 'List all Health Institutions | e-Demic')
@section('page_heading', 'List all Health Institutions')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title">List all Health Institutions</h4> -->
                    <a class="heading-elements-toggle">
                        <i class="la la-ellipsis-v font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <a href="{{ route('institution_institutions.create') }}" class="btn btn-info btn-sm">
                            <i class="ft-plus white"></i> Add Health Institution
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>Institution Code</th>
                                    <th>Health Institution</th>
                                    <th>Email ID</th>
                                    <th>Phone Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($health_institutions as $health_institution)
                                    <tr>
                                        <td> {{ $health_institution->institutionCode }}</td>
                                        <td> {{ $health_institution->name }}</td>
                                        <td> {{ $health_institution->email }} </td>
                                        <td> {{ $health_institution->health_institution_profile->phone }} </td>
                                        <td class="no-wrap">
                                            <a href="{{ route('institution_institutions.edit', $health_institution->uuid ) }}" class="btn btn-icon btn-info btn-sm"> <i class="la la-edit"></i> </a>

                                            {!! Form::open(array(
                                                    'route' => array('institution_institutions.delete', $health_institution->uuid),
                                                    'method' => 'delete',
                                                    'class'=>'delSwalForm',
                                                    'style'=>'display:inline'
                                            )) !!}

                                            <button type="submit" class="btn btn-icon btn-danger btn-sm delSwal"> <i class="la la-trash"></i> </button>

                                            {!! Form::close() !!}
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