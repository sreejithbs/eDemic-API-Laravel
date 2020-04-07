@extends('_health_institution.partials.master')
@section('page_title', 'Edit Message | e-Demic')
@section('page_heading', 'Edit Message')

@section('content')

<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle">
                        <i class="la la-ellipsis-v font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <a href="{{ route('institution_messages.list') }}" class="btn btn-sm bg-blue-grey white">
                            <i class="ft-chevrons-left"></i> Back to Messages Listing
                        </a>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form method="post" action="{{ route('institution_messages.update', $message->uuid) }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-edit"></i> Message Info</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="title">Title *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="title" class="form-control" placeholder="Message Title" name="title" value="{{ $message->title }}" required data-parsley-required-message="Please enter Message Title">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control" for="content">Content *</label>
                                    <div class="col-md-9">
                                        <textarea id="content" rows="5" class="form-control" name="content" placeholder="Message Content" required data-parsley-required-message="Please enter Message Content">{{ $message->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('institution_messages.list') }}" class="btn btn-secondary mr-1">
                                    <i class="la la-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="la la-check-square-o"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection