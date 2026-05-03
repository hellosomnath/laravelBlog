@extends('layout')

@section('page_title', "Blog Listing")

@section('content')

@include('partials._hero')

<!-- blog grid section-->
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="co-md-12 header" style="margin-bottom: 20px;">
			    <!-- top search form -->
			    @if (isset($sort))
			    <div class="top-search">
			    	<select name="sort" onchange="window.location.href='/blogs?sort='+this.value;" style="width: 30%; border-right: 1px solid #020d18;">
						<option value="sbpa" {{$sort == 'sbpa' ? 'selected' : ''}}>Published (ASC)</option>
						<option value="sbpd" {{$sort == 'sbpd' ? 'selected' : ''}}>Published (DESC)</option>
						<option value="sbva" {{$sort == 'sbva' ? 'selected' : ''}}>Views (ASC)</option>
						<option value="sbvd" {{$sort == 'sbvd' ? 'selected' : ''}}>Views (DESC)</option>
						<option value="sbaa" {{$sort == 'sbaa' ? 'selected' : ''}}>Author (ASC)</option>
						<option value="sbad" {{$sort == 'sbad' ? 'selected' : ''}}>Author (DESC)</option>
					</select>
					<form action="{{ url('/blog-search') }}" class="inline-form" style="width: 100%;">
						<input type="text" name="search" placeholder="Search blog">
					</form>
			    </div>
			    @endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				@foreach ($blogs as $blog)
				<div class="blog-item-style-1 blog-item-style-3">
					@if ($blog->feature_image)
						<img class="feature_image" src="{{ asset($blog->feature_image) }}" alt="">
					@else
						<img class="feature_image" src="{{ asset('assets/images/logo1.png') }}" alt="" style="max-width: 100px;">
					@endif
					<div class="blog-it-infor">
						<h3><a href="{{ url('/blogs/'. $blog->id) }}">{{ $blog->title }}</a></h3>
						<span class="time"><span class="ion-ios-calendar-outline"></span> {{date('d-m-Y', strtotime($blog->published_on))}}&nbsp;&nbsp;<span class="ion-ios-person"></span> {{$blog->author}}</span>
						<p>{!! strlen($blog->content) > 200 ? substr($blog->content, 0, 200) . "..." : substr($blog->content, 0, 200) !!}</p>

					</div>
				</div>
				@endforeach

				{{-- pagination --}}
				@if (isset($searchTerm))
					{{$blogs->withQueryString()->links()}}
				@else
					{{$blogs->links()}}
				@endif
				{{-- pagination ends --}}

			</div>
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="sidebar">
					@if (!isset($sort))
					<div class="sb-search sb-it">
						<h4 class="sb-title">Search</h4>
						<form action="{{ url('/blog-search') }}">
							<input type="text" name="search" placeholder="Enter keywords">
						</form>
					</div>
					@endif
					<div class="sb-cate sb-it">
						<h4 class="sb-title">Categories</h4>
						<div class="top-search">
							<select  onchange="window.location.href='/category/' + this.value;">
								<option value="">Select a category</option>
								@foreach($categories as $category)
								<option value="{{ $category->category_name }}">{{ strtoupper($category->category_name) . ' (' . $category->blogs_count . ')' }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="sb-recentpost sb-it">
						<h4 class="sb-title">most recent</h4>
						@for ($i = 0; $i < 3; $i++)
						<div class="recent-item">
							@if (!empty($latest_blog[$i]))
							<span>{{$i+1}}</span><h6><a href="{{ url('/blogs/' . $latest_blog[$i]->id) }}">{{$latest_blog[$i]->title}}</a></h6>
							@endif
						</div>
						@endfor
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end of  blog grid section-->
@endsection