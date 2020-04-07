@extends('_health_institution.partials.master')
@section('page_title', 'List all Doctors | e-Demic')
@section('page_heading', 'List all Doctors')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle">
                        <i class="la la-ellipsis-v font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <a href="{{ route('institution_doctors.create') }}" class="btn btn-info btn-sm">
                            <i class="ft-plus white"></i> Add Doctor
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Doctor Name</th>
                                    <th>Email ID</th>
                                    <th>Phone Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                    <tr>
                                        <td> {{ $doctor->userCode }}</td>
                                        <td> {{ $doctor->doctor_profile->name }}</td>
                                        <td> {{ $doctor->doctor_profile->email }}</td>
                                        <td> {{ $doctor->phone }}</td>
                                        <td class="no-wrap">
                                            <a href="{{ route('institution_doctors.edit', $doctor->uuid ) }}" class="btn btn-icon btn-info btn-sm"> <i class="la la-edit"></i> </a>

                                            {!! Form::open(array(
                                                    'route' => array('institution_doctors.delete', $doctor->uuid),
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