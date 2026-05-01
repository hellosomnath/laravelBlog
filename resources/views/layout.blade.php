<!DOCTYPE html>
<html lang="en" class="no-js">

<!-- bloggrid12:22-->
<head>
	<!-- Basic need -->
	<title>LaravelBlog - @yield('page_title')</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

	<!--Google Font-->
	{{-- <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' /> --}}
	<!-- Mobile specific meta -->
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- CSS files -->
	<link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">

</head>
<body>
	<!--preloading-->
	<div id="preloader">
		<img class="logo" src="{{ asset('assets/images/logo1.png') }}" alt="" width="200" height="100">
		<div id="status">
			<span></span>
			<span></span>
		</div>
	</div>
	<!--end of preloading-->
	{{-- Form section --}}
	@include('partials._login')
	{{-- Form section ends --}}

	<!-- BEGIN | Header -->
	@include('partials._header')
	<!-- END | Header -->

	@yield('content')

	<!-- footer section-->
	@include('partials._footer')
	<!-- end of footer section-->

	<script src="{{ asset('assets/js/jquery.js') }}"></script>
	<script src="{{ asset('assets/js/plugins.js') }}"></script>
	<script src="{{ asset('assets/js/plugins2.js') }}"></script>
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	@yield('custom-scripts')
</body>

</html>