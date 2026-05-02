@extends('layout')

@section('page_title', 'Categories')

@section('content')

@include('partials._hero')

<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="blog-detail-ct">
					<div class="comment-form blog-form" id="catForm">
						<div class="row">
							@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</div>
						<div class="row">
						<div class="col-md-6">
							<h4>Add a category</h4>
							
							<form method="post" action="{{ url('submit-category')}}" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-12">
										<input type="text" name="category"placeholder="Category" value="">
									</div>
								</div>
								<input class="submit" type="submit" placeholder="submit">
							</form>
						</div>
						<div class="col-md-6">
							<h4>Update a category</h4>
							<form method="post" action="{{ url('submit-category')}}" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="category_id" id="cat_id" value="{{null}}">
								<div class="row">
									<div class="col-md-12">
										<input type="text" name="category" id="cat_name" placeholder="Category" value="">
									</div>
								</div>
								<input class="submit" type="submit" placeholder="submit">
							</form>
						</div>
						</div>
					</div>
					<div class="sidebar blog-form" style="margin-left: 0;">
						<div class="sb-cate sb-it" style="max-height: 300px; overflow-y: scroll; margin-bottom: 0">
							<h4 class="sb-title">Categories</h4>
							@if (session()->has('success'))
								<div class="alert alert-info">
									{{ session()->get('success') }}
								</div>
							@endif
							<ul>
								@foreach ($categories as $category)
								<li>
									<a href="{{ url('category/'.$category->category_name) }}">{{ $category->category_name }} ({{$category->blogs_count}})</a>
									&nbsp;
									<a class="btn action-btn-edit" href="#" cat_id="{{$category->id}}" cat_name="{{$category->category_name}}"><span class="ion-ios-paper"></span> Edit</a>

									&nbsp;

									<form class="inline-form" method ="post" action="{{ url('category/delete/'.$category->id)}}">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn action-btn-delete" onclick="return confirm('are you sure, your want to delete this item?')"><span class="ion-ios-trash"></span> Delete</button>
									</form>
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
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
					<div class="sb-tags sb-it">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-scripts')
<script>
	$(document).ready(function() {
		$(".action-btn-edit").on('click', function(e) {
			e.preventDefault();
			var cat_id = $(this).attr('cat_id');
			var cat_name = $(this).attr('cat_name');
			$("#cat_id").val(cat_id);
			$("#cat_name").val(cat_name);
			$(window).scrollTop($('#catForm').offset().top);
		});
	});
</script>
@endsection