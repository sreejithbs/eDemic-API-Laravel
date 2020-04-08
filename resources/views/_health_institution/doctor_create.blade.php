@extends('_health_institution.partials.master')
@section('page_title', 'Add New Doctor | e-Demic')
@section('page_heading', 'Add New Doctor')

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
                        <button type="button" class="btn btn-sm btn-primary">
                            Remaining Accounts : {{ $remainingDoctorConnects }}
                        </button>
                        <a href="{{ route('institution_doctors.list') }}" class="btn btn-sm bg-blue-grey white">
                            <i class="ft-chevrons-left"></i> Back to Doctors Listing
                        </a>
                    </div>
                </div>

                @if($remainingDoctorConnects == 0)
                    @include('_health_institution.components.institution_doctor')
                @else
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <form method="post" action="{{ route('institution_doctors.store') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                                {{ csrf_field() }}

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-edit"></i> Doctor Info</h4>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="name"> Name *</label>
                                        <div class="col-md-9">
                                            <input type="text" id="name" class="form-control" placeholder="Doctor Name" name="name" required data-parsley-required-message="Please enter Doctor Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="email">Email *</label>
                                        <div class="col-md-9">
                                            <input type="email" id="email" class="form-control" placeholder="Email" name="email" required data-parsley-required-message="Please enter Email">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-md-3 label-control" for="phone_number">Phone Number *</label>
                                        <div class="col-md-9">
                                            <input type="number" id="phone_number" class="form-control" placeholder="Phone Number" name="phone_number" required data-parsley-required-message="Please enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="form-group row last">
                                        <label class="col-md-3 label-control">Profile QR Code</label>
                                        <div class="col-md-3 text-center">
                                            <!-- <div class="card"> -->
                                                <!-- <div class="card-content"> -->
                                                    <!-- <div class="card-body my-gallery"> -->
                                                        <!-- <div class="card-deck-wrapper"> -->
                                                            <!-- <div class="card-deck"> -->
                                                                <!-- <figure class="card card-img-top border-grey border-lighten-2"> -->
                                                                    <img class="gallery-thumbnail card-img-top" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->color(30, 160, 240)->errorCorrection('H')->generate('Doctor Profile QRCode')) !!}" alt="QrCode" />
                                                                    <!-- <h4 class="card-title">Doctor Profile</h4> -->
                                                                <!-- </figure> -->
                                                            <!-- </div> -->
                                                        <!-- </div> -->
                                                    <!-- </div> -->
                                                <!-- </div> -->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <a href="{{ route('institution_doctors.list') }}" class="btn btn-secondary mr-1">
                                        <i class="la la-close"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection