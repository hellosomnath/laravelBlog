@extends('layout')

@section('page_title', 'Create Blog')

@section('content')
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="blog-detail-ct">
					<div class="comment-form blog-form">
						<h4>Write a blog</h4>
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
						<form method="post" action="{{ url('blogs')}}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
							<input type="hidden" name="author" value="{{ auth()->user()->name }}">
							<div class="row">
								<div class="col-md-12">
									<label for="">Title*</label>
									<input type="text" name="title" placeholder="Title" value="{{ old('title') }}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="">Content*</label>
									<textarea class="ckeditor" name="content" id="content" placeholder="Message">{{ old('content') }}</textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 top-search">
									<label for="">Category*</label>
									<select name="category_id">
										<option value="">Select a category</option>
										@foreach($categories as $category)
										<option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? "selected" : "" }}>{{ $category->category_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="">Feature Image</label>
									<input type="file" name="feature_image">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<label for="">Tags</label>
									<input type="text" name="tags" placeholder="Tags" value="{{ old('tags') }}">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="">Published on*</label>
									<input type="text" class="datepicker" name="published_on" placeholder="Published on" value="{{ old('published_on') }}">
								</div>
								<div class="col-md-6 top-search">
									<label for="">Published</label>
									<select name="is_published">
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
								
							</div>
							<input class="submit" type="submit" placeholder="submit">
						</form>
					</div>
					<!-- comment form -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-scripts')
<script>
	$(document).ready(function() {
		$('.datepicker').datepicker({
					format: 'dd-mm-yyyy',
					endDate: '+0d'
				});
	});
</script>
@endsection