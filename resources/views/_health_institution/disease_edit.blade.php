@extends('_health_institution.partials.master')
@section('page_title', 'Edit Disease | e-Demic')
@section('page_heading', 'Edit Disease')

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
                        <a href="{{ route('institution_diseases.list') }}" class="btn btn-sm bg-blue-grey white">
                            <i class="ft-chevrons-left"></i> Back to Diseases Listing
                        </a>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form method="post" action="{{ route('institution_diseases.update', $disease->uuid) }}" class="form form-horizontal form-bordered" novalidate="" data-parsley-validate="" autocomplete="off">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-edit"></i> Disease Info</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="name">Disease Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" class="form-control" placeholder="Disease Name" name="name" required data-parsley-required-message="Please enter Disease Name" value="{{ $disease->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Code</label>
                                    <div class="col-md-9">
                                        <input type="text" id="code" class="form-control" placeholder="Disease Code" name="code" value="{{ $disease->diseaseCode }}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control">Choose Risk Level *</label>
                                    <div class="col-md-9">
                                        <div class="input-group skin skin-square">
                                            <div class="d-inline-block custom-control custom-radio" style="padding-left: 0px;">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_1" value="1" required data-parsley-required-message="Please choose Risk Level" data-parsley-errors-container="#level_errorDiv" {{ ($disease->riskLevel == 1) ? 'checked' : '' }}>
                                                <label for="level_1">Risk Level 1</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_2" value="2" {{ ($disease->riskLevel == 2) ? 'checked' : '' }}>
                                                <label for="level_2">Risk Level 2</label>
                                            </div>
                                            <div class="d-inline-block custom-control custom-radio">
                                                <input type="radio" name="risk_level" class="custom-control-input" id="level_3" value="3" {{ ($disease->riskLevel == 3) ? 'checked' : '' }}>
                                                <label for="level_3">Risk Level 3</label>
                                            </div>
                                        </div>
                                        <div id="level_errorDiv"></div>
                                    </div>
                                </div>
                                <div class="form-group row last">
                                    <label class="col-md-3 label-control">Generated QR Codes</label>
                                    <div class="col-md-9 text-center">
                                        <!-- <div class="card"> -->
                                            <!-- <div class="card-content"> -->
                                                <div class="card-body my-gallery">
                                                    <div class="card-deck-wrapper">
                                                        <div class="card-deck">
                                                            <figure class="card card-img-top border-grey border-lighten-2">
                                                                <img class="gallery-thumbnail card-img-top" src="{{ asset($disease->infectionQrCode) }}" alt="Image description" />
                                                                <h4 class="card-title">Infection</h4>
                                                            </figure>
                                                            <figure class="card card-img-top border-grey border-lighten-2">
                                                                <img class="gallery-thumbnail card-img-top" src="{{ asset($disease->recoveredQrCode) }}" alt="Image description" />
                                                                <h4 class="card-title">Recovered</h4>
                                                            </figure>
                                                            <figure class="card card-img-top border-grey border-lighten-2">
                                                                <img class="gallery-thumbnail card-img-top" src="{{ asset($disease->deadQrCode) }}" alt="Image description" />
                                                                <h4 class="card-title">Dead</h4>
                                                            </figure>
                                                            <figure class="card card-img-top border-grey border-lighten-2">
                                                                <img class="gallery-thumbnail card-img-top" src="{{ asset($disease->selfQuarantineQrCode) }}" alt="Image description" />
                                                                <h4 class="card-title">Self Quarantine</h4>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('institution_diseases.list') }}" class="btn btn-secondary mr-1">
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
        $('#generate_code').on('ifChanged', function(event) {
            if(event.target.checked){
                $("#code").prop('readonly', true).val('D{{ StringHelper::randString(7) }}');
            } else {
                $("#code").prop('readonly', false).val('');
            }
        });
    });
</script>

@endpush