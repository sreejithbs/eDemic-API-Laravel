@extends('_admin.partials.master')
@section('page_title', 'List all Accounts | e-Demic')
@section('page_heading', 'List all Accounts')

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered table-responsive dtTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country</th>
                                    <th>Health Institution</th>
                                    <th>Particulars</th>
                                    <th>Amount</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ \DB::table('countries')->find($payment->health_institution->country_id)->name }} </td>
                                        <td> {{ $payment->health_institution->name }} </td>
                                        <td> {{ $payment->remarks }} </td>
                                        <td class="no-wrap"> $ {{ $payment->amount }} </td>
                                        <td> {{ $payment->created_at->format('Y-m-d') }}</td>
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