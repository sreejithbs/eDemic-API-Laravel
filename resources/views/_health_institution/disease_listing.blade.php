@extends('_health_institution.partials.master')
@section('page_title', 'List all Diseases | e-Demic')
@section('page_heading', 'List all Diseases')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @can('isCountryHead')
                    <div class="card-header">
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <a href="{{ route('institution_diseases.create') }}" class="btn btn-info btn-sm">
                                <i class="ft-plus white"></i> Add Disease
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>Disease Code</th>
                                    <th>Disease Name</th>
                                    <th>Risk Level</th>
                                    @can('isCountryHead')
                                        <th>Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($diseases as $disease)
                                    <tr>
                                        <td> {{ $disease->diseaseCode }}</td>
                                        <td> {{ $disease->name }}</td>
                                        <td>
                                            @if( $disease->riskLevel == 0 )
                                                -- None --
                                            @elseif( $disease->riskLevel == 1 )
                                                <span class="badge bg-yellow bg-darken-1"> Level 1 </span>
                                            @elseif( $disease->riskLevel == 2 )
                                                <span class="badge badge-warning"> Level 2 </span>
                                            @elseif( $disease->riskLevel == 3 )
                                                <span class="badge badge-danger"> Level 3 </span>
                                            @endif
                                        </td>
                                        @can('isCountryHead')
                                            <td class="no-wrap">
                                                <!-- <a href="{{ route('institution_diseases.edit', $disease->uuid ) }}" class="btn btn-icon btn-info btn-sm"> <i class="la la-edit"></i> </a> -->

                                                {!! Form::open(array(
                                                        'route' => array('institution_diseases.delete', $disease->uuid),
                                                        'method' => 'delete',
                                                        'class'=>'delSwalForm',
                                                        'style'=>'display:inline'
                                                )) !!}

                                                <button type="submit" class="btn btn-icon btn-danger btn-sm delSwal"> <i class="la la-trash"></i> </button>

                                                {!! Form::close() !!}
                                            </td>
                                        @endcan
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