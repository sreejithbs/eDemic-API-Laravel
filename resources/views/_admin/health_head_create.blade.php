@extends('_admin.partials.master')
@section('page_title', 'Add New Health Head | e-Demic')
@section('page_heading', 'Add New Health Head')

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
                        <a href="{{ route('admin_health_heads.list') }}" class="btn btn-sm bg-blue-grey white">
                            <i class="ft-chevrons-left"></i> Back to Health Heads Listing
                        </a>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form method="post" action="{{ route('admin_health_heads.store') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-edit"></i> Health Head Info</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control" placeholder="Name" name="name" required data-parsley-required-message="Please enter Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="email">Email *</label>
                                    <div class="col-md-9">
                                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" required data-parsley-required-message="Please enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="country">Select Country *</label>
                                    <div class="col-md-9">
                                        <select id="country" class="form-control select2" name="country" required data-parsley-required-message="Please Select a Country" data-parsley-errors-container="#country_errorDiv">
                                            <option value="">-- Select an option --</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}"> {{ $country->isoAlphaCode }} - {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                        <div id="country_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Generate/Enter UID *</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group skin skin-square">
                                                    <div class="d-inline-block custom-control custom-checkbox" style="padding-left: 0px; padding-top: 8px;">
                                                        <input type="checkbox" class="custom-control-input" id="generate_uid">
                                                        <label for="generate_uid">Auto-Generate</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="uid" class="form-control" placeholder="Health Head UID" name="uid" required data-parsley-maxlength="8" data-parsley-required-message="Please enter/generate Health Head UID">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Generate/Enter Password *</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="input-group skin skin-square">
                                                    <div class="d-inline-block custom-control custom-checkbox" style="padding-left: 0px; padding-top: 8px;">
                                                        <input type="checkbox" class="custom-control-input" id="generate_password">
                                                        <label for="generate_password">Auto-Generate</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" id="password" class="form-control" placeholder="Health Head Password" name="password" required data-parsley-maxlength="8" data-parsley-required-message="Please enter/generate Health Head Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('admin_health_heads.list') }}" class="btn btn-secondary mr-1">
                                    <i class="la la-close"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="la la-check-square-o"></i> Save
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

@push('page_scripts')

<script type="text/javascript">
    $("document").ready(function(){
        $('#generate_uid').on('ifChanged', function(event) {
            if(event.target.checked){
                $("#uid").prop('readonly', true).val('CHH{{ StringHelper::randString(5) }}');
            } else {
                $("#uid").prop('readonly', false).val('');
            }
        });

        $('#generate_password').on('ifChanged', function(event) {
            if(event.target.checked){
                $("#password").prop('readonly', true).val('{{ StringHelper::randString(8) }}');
            } else {
                $("#password").prop('readonly', false).val('');
            }
        });
    });
</script>

@endpush