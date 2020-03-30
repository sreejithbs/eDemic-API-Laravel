@extends('_health_institution.partials.master')
@can('isCountryHead')
	@section('page_title', 'Country Health Head Dashboard | e-Demic')
	@section('page_heading', 'Country Health Head Dashboard')
@else
	@section('page_title', 'Health Institution Dashboard | e-Demic')
	@section('page_heading', 'Health Institution Dashboard')
@endcan

@section('content')

<div class="alert bg-success alert-icon-left mb-2" role="alert">
    <span class="alert-icon"><i class="la la-info"></i></span>
    <strong>Welcome</strong>
    <p>You have successfully logged in!</p>
</div>

@endsection