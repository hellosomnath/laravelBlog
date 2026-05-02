@extends('layout')

@section('page_title', "Home")

@section('content')
{{-- @include('partials._hero') --}}
<div class="page-single">
	<div class="container">
		<div class="landing-hero">
			<img src="{{ asset('assets/images/logo1.png') }}" alt="Logo">
			<div class="row landing-hero-text">
				<h2>MOST COMPLETE</h2>
				<h2 class="text-yellow">WEBSITE FOR BLOGGER</h2>
			</div>
			<a href="{{ url('/blogs') }}" class="redbtn">DISCOVER BLOGS</a>
		</div>
	</div>
</div>
@endsection