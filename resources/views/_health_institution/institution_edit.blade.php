@extends('_health_institution.partials.master')
@section('page_title', 'Edit Health Institution | e-Demic')
@section('page_heading', 'Edit Health Institution')

@section('content')

<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h4 class="card-title">List all Health Institutions</h4> -->
                    <a class="heading-elements-toggle">
                        <i class="la la-ellipsis-v font-medium-3"></i>
                    </a>
                    <div class="heading-elements">
                        <a href="{{ route('institution_institutions.list') }}" class="btn btn-sm bg-blue-grey white">
                            <i class="ft-chevrons-left"></i> Back to Institutions Listing
                        </a>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form method="post" action="{{ route('institution_institutions.update', $health_institution->uuid) }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-edit"></i> Institution Info</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Institution Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control" placeholder="Institution Name" name="name" value="{{ $health_institution->name }}" required data-parsley-required-message="Please enter Institution Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{ $health_institution->email }}" disabled="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 label-control" for="phone_number">Phone Number *</label>
                                    <div class="col-md-9">
                                        <input type="number" id="phone_number" class="form-control" placeholder="Phone Number" name="phone_number" value="{{ $health_institution->health_institution_profile->phone }}" required data-parsley-required-message="Please enter Phone Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="address">Institution Address *</label>
                                    <div class="col-md-9">
                                        <textarea id="address" rows="5" class="form-control" name="address" placeholder="Institution Address" required data-parsley-required-message="Please enter Institution Address">{{ $health_institution->health_institution_profile->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">UID</label>
                                    <div class="col-md-9">
                                        <input type="text" id="uid" class="form-control" placeholder="UID" name="uid" value="{{ $health_institution->institutionCode }}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Password</label>
                                    <div class="col-md-9">
                                        <input type="text" id="password" class="form-control" placeholder="Password" name="password" value="************" disabled="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('institution_institutions.list') }}" class="btn btn-secondary mr-1">
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