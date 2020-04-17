@extends('_admin.partials.master')
@section('page_title', 'List all Health Heads | e-Demic')
@section('page_heading', 'List all Health Heads')

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
                        <a href="{{ route('admin_health_heads.create') }}" class="btn btn-info btn-sm">
                            <i class="ft-plus white"></i> Add Health Head
                        </a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>Health Head</th>
                                    <th>Email ID</th>
                                    <th>Country</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($health_heads as $health_head)
                                    <tr>
                                        <td> {{ $health_head->name }}</td>
                                        <td> {{ $health_head->email }} </td>
                                        <td> {{ \DB::table('countries')->find($health_head->country_id)->name }} </td>
                                        <td>
                                            @if($health_head->isActive == 1)
                                                <a href="{{ route('admin_health_heads.toggleStatus', $health_head->uuid ) }}" class="btn btn-icon btn btn-warning btn-sm"> <i class="la la-ban"></i> Deactivate </a>
                                            @else
                                                <a href="{{ route('admin_health_heads.toggleStatus', $health_head->uuid ) }}" class="btn btn-icon btn btn-success btn-sm"> <i class="la la-check-circle"></i> Activate </a>
                                            @endif

                                            {!! Form::open(array(
                                                    'route' => array('admin_health_heads.delete', $health_head->uuid),
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