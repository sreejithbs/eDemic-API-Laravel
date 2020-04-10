@extends('_health_institution.partials.master')
@section('page_title', 'Edit Disease Risk Level | e-Demic')
@section('page_heading', 'Edit Disease Risk Level')

@section('content')

<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <form method="post" action="{{ route('institution_diseases.updateRiskLevel') }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-edit"></i> Disease Risk Level Info</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="disease">Select Disease *</label>
                                    <div class="col-md-9">
                                        <select id="disease" class="form-control select2" name="disease" required data-parsley-required-message="Please Select a Disease" data-parsley-errors-container="#disease_errorDiv">
                                            <option value="">-- Select an option --</option>
                                            @foreach($diseases as $disease)
                                                <option value="{{ $disease->uuid }}"> {{ $disease->name }} (Risk Level {{ $disease->riskLevel }}) </option>
                                            @endforeach
                                        </select>
                                        <div id="disease_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Choose Risk Level *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_0" value="0" required data-parsley-required-message="Please choose Risk Level" data-parsley-errors-container="#level_errorDiv">
                                                <label for="level_0">None</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_1" value="1">
                                                <label for="level_1">Risk Level 1</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_2" value="2">
                                                <label for="level_2">Risk Level 2</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_3" value="3">
                                                <label for="level_3">Risk Level 3</label>
                                            </div>
                                        </div>
                                        <div id="level_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Enter your Login Password *</label>
                                    <div class="col-md-9">
                                        <input type="password" id="password" class="form-control" placeholder="Login Password" name="password" required data-parsley-maxlength="8" data-parsley-required-message="Please enter Login Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('institution_diseases.editRiskLevel') }}" class="btn btn-secondary mr-1">
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

@push('page_scripts')

<script type="text/javascript">
    $("document").ready(function(){

        $("#disease").change(function(){
            var $elm = $(this).find('option:selected');
            if($elm.val() == ""){
                toastr.error('Please select a Disease', 'Error !', {timeOut: 1500});
                $('input:radio[name=risk_level]').iCheck('uncheck');
                return;
            }
            $.ajax({
                url: "{{ URL::route('institution_diseases.fetchRiskLevel') }}",
                dataType: 'json',
                type: 'POST',
                data: {
                    'disease' : $elm.val()
                },
                success:function(response){
                    if (response.status) {
                        $('input:radio[name=risk_level]').iCheck('uncheck');
                        $('#level_' + response.level).prop('checked', true).iCheck('update');
                    }
                },
                error:function(response) {
                    console.log('inisde ajax error handler');
                }
            });
        });

    });
</script>

@endpush