@extends('_health_institution.partials.master')
@section('page_title', 'License Payment Checkout | e-Demic')
@section('page_heading', 'License Payment Checkout')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form method="post" action="{{ route('institution_checkout.store', 'licence') }}" class="form">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Payment Details</h3><hr/>
                                        </div>
                                        <div class="panel-body">
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Card Holder Name</label>
                                                        <input type="text" id="card_holder_name" name="card_holder_name" maxlength="70" class="form-control" placeholder="Card Holder Name" value="Test Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Card Number</label>
                                                        <input type="tel" id="card_number" maxlength="18" class="form-control" placeholder="Card Number" value="4242424242424242">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label" for="">Expiry Month</label>
                                                        {!! Form::selectMonth('card_expiry_month', null, ['id' => 'card_expiry_month', 'class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Expiry Year</label>
                                                        {!! Form::selectYear('card_expiry_year', date('Y'), date('Y') + 15, 'S', ['id' => 'card_expiry_year', 'class'=>'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">CVC</label>
                                                        <input type="tel" id="card_cvc" maxlength="4" class="form-control" placeholder="CVC" value="123">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Order Summary</h3><hr/>
                                        </div>
                                        @php $feeAmount = 999; @endphp
                                        <div class="panel-body">
                                            <table class="table table-borderless table-responsive">
                                                <tr class="no-border">
                                                    <td><strong>Basic Package : </strong></td>
                                                    <td> ${{ $feeAmount }} </td>
                                                </tr>

                                                @if($_COOKIE['status'] == 'institution')
                                                    @php
                                                        $docs = $_COOKIE['docs'];
                                                        $docsTotal = $docs * 50;
                                                        $feeAmount += $docsTotal;
                                                    @endphp
                                                    <tr class="no-border">
                                                        <td><strong>Doctors x {{ $docs }} : </strong></td>
                                                        <td> ${{ $docsTotal }} </td>
                                                    </tr>
                                                    <input type="hidden" name="purchasedDoctorConnects" value="{{ $docs }}">
                                                @endif
                                                <input type="hidden" name="feeAmount" value="{{ $feeAmount }}">

                                            </table>
                                            <div class="row">
                                                <div class="col-md-6"> <h4><strong> Total Amount </strong></h4></div>
                                                <div class="col-md-6 text-right"> <h4><strong> ${{ $feeAmount }} </strong></h4></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <button type="submit" class="btn btn-success btn-lg btn-block">Purchase Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection