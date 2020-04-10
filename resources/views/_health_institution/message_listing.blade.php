@extends('_health_institution.partials.master')
@section('page_title', 'List all Messages | e-Demic')
@section('page_heading', 'List all Messages')

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
                            <a href="{{ route('institution_messages.create') }}" class="btn btn-info btn-sm">
                                <i class="ft-plus white"></i> Add Message
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $message->title }}</td>
                                        <td> {{ $message->content }} </td>
                                        <td class="no-wrap">

                                            <a href="{{ route('institution_messages.triggerPushMessage', $message->uuid ) }}" class="btn btn-icon btn-success btn-sm"> <i class="la la-paper-plane"></i> Send Push</a>

                                            @can('isCountryHead')
                                                <a href="{{ route('institution_messages.edit', $message->uuid ) }}" class="btn btn-icon btn-info btn-sm"> <i class="la la-edit"></i> </a>

                                                {!! Form::open(array(
                                                        'route' => array('institution_messages.delete', $message->uuid),
                                                        'method' => 'delete',
                                                        'class'=>'delSwalForm',
                                                        'style'=>'display:inline'
                                                )) !!}

                                                <button type="submit" class="btn btn-icon btn-danger btn-sm delSwal"> <i class="la la-trash"></i> </button>

                                                {!! Form::close() !!}
                                            @endcan
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