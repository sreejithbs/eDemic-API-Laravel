@extends('_health_institution.partials.master')
@can('isCountryHead')
	@section('page_title', 'Country Health Head Dashboard | e-Demic')
	@section('page_heading', 'Country Health Head Dashboard')
@else
	@section('page_title', 'Health Institution Dashboard | e-Demic')
	@section('page_heading', 'Health Institution Dashboard')
@endcan

@section('content')

	@can('isCountryHead')
	    @include('_health_institution.components.countryhead_licence')
	@else
	    @include('_health_institution.components.institution_licence')
	@endcan

@endsection