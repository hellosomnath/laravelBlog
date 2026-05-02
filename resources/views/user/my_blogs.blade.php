@extends('layout')

@section('page_title', "My Blogs")

@section('content')

@include('partials._hero')

<!-- blog grid section-->
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				@if (session()->has('success'))
					<div class="alert alert-info">
						{{ session()->get('success') }}
					</div>	
				@endif

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
						{!! strlen($blog->content) > 200 ? substr($blog->content, 0, 200) . "..." : substr($blog->content, 0, 200) !!}

						<a class="btn action-btn-edit" href="{{ url('blogs/'.$blog->id . '/edit')}}"><span class="ion-ios-paper"></span> Edit</a>

						&nbsp;

						<form class="inline-form" method ="post" action="{{ url('blogs/'.$blog->id)}}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn action-btn-delete" onclick="return confirm('are you sure, your want to delete this item?')"><span class="ion-ios-trash"></span> Delete</button>
						</form>
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
					<div class="sb-search sb-it">
						<h4 class="sb-title">Search</h4>
						<form action={{ url('/blog-search') }}>
							<input type="text" name="search" placeholder="Enter keywords">
						</form>
					</div>
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