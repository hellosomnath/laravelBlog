@extends('layout')

@section('page_title', "Home")

@section('content')
{{-- @include('partials._hero') --}}
<div class="page-single">
	<div class="container">
		<div class="landing-hero" style="margin-top: 50px;">
			<img src="{{ asset('assets/images/logo1.png') }}" alt="Logo">
			<div class="row landing-hero-text">
				<h2>MOST COMPLETE</h2>
				<h2 class="text-yellow">WEBSITE FOR BLOGGER</h2>
			</div>
			<a href="{{ url('/blogs') }}" class="redbtn">DISCOVER BLOGS</a>
		</div>

		<!-- blog grid section-->
		<div class="page-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						{{-- popular blogs --}}
						<div class="row blog-form">
							<div style="position: relative;">
								<h3 class="text-white">POPULAR BLOGS</h3>
								<a href="http://localhost:8000/blogs" class="publish">VIEW ALL</a>
								<hr>
							</div>
							@foreach ($popular_blogs as $blog)
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="blog-item-style-2">
									@if ($blog->feature_image)
									<img class="feature_image" src="{{ asset($blog->feature_image) }}" alt="">
									@else
									<img class="feature_image" src="{{ asset('assets/images/logo1.png') }}" alt="" style="max-width: 100px;">
									@endif
									{{-- <a href="blogdetail.html"><img src="images/uploads/blogv21.jpg" alt=""></a> --}}
									<div class="blog-it-infor">
										<h3><a href="{{ url('/blogs/'. $blog->id) }}">{{ $blog->title }}</a></h3>
										<span class="time"><span class="ion-ios-calendar-outline"></span> {{date('d-m-Y', strtotime($blog->published_on))}}&nbsp;&nbsp;<span class="ion-ios-person"></span> {{$blog->author}}</span>
										{!! strlen($blog->content) > 100 ? substr($blog->content, 0, 100) . "..." : substr($blog->content, 0, 100) !!}
									</div>
								</div>
							</div>
							@endforeach
						</div>


						{{-- latest blog --}}
						<div class="row blog-form">
							<div style="position: relative;">
								<h3 class="text-white">LATEST BLOGS</h3>
								<a href="http://localhost:8000/blogs" class="publish">VIEW ALL</a>
								<hr>
							</div>							
							@foreach ($latest_blog as $blog)
							<div class="col-md-3 col-sm-6 col-xs-12">
								<div class="blog-item-style-2">
									@if ($blog->feature_image)
									<img class="feature_image" src="{{ asset($blog->feature_image) }}" alt="">
									@else
									<img class="feature_image" src="{{ asset('assets/images/logo1.png') }}" alt="" style="max-width: 100px;">
									@endif
									{{-- <a href="blogdetail.html"><img src="images/uploads/blogv21.jpg" alt=""></a> --}}
									<div class="blog-it-infor">
										<h3><a href="{{ url('/blogs/'. $blog->id) }}">{{ $blog->title }}</a></h3>
										<span class="time"><span class="ion-ios-calendar-outline"></span> {{date('d-m-Y', strtotime($blog->published_on))}}&nbsp;&nbsp;<span class="ion-ios-person"></span> {{$blog->author}}</span>
										{!! strlen($blog->content) > 100 ? substr($blog->content, 0, 100) . "..." : substr($blog->content, 0, 100) !!}
									</div>
								</div>
							</div>
							@endforeach
						</div>
						{{-- latest blog ends --}}

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection