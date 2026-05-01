@extends('layout')

@section('page_title', 'Page Not Found')

@section('content')
<div class="page-single-2">
	<div class="container">
		<div class="row">
			<div class="middle-content" style="margin-top: 100px;">
				<h1>PAGE NOT FOUND</h1>
				<a href="{{url('/')}}" class="redbtn">go home</a>
			</div>
		</div>
	</div>
</div>
@endsection