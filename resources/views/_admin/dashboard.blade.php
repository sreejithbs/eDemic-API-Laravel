@extends('_admin.partials.master')
@section('page_title', 'Accounts | e-Demic')
<!-- @section('page_title', 'Super-Admin Dashboard | e-Demic') -->
@section('page_heading', 'Accounts')
<!-- @section('page_heading', 'Super-Admin Dashboard') -->

@section('content')

<!-- <div class="alert bg-success alert-icon-left mb-2" role="alert">
    <span class="alert-icon"><i class="la la-check-circle"></i></span>
    <strong>Welcome</strong>
    <p>You have successfully logged in!</p>
</div> -->

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dtTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Country</th>
                                    <th>Health Head</th>
                                    <th>Year</th>
                                    <th>Payment</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<!--  -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection