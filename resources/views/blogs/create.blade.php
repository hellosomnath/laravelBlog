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
									<div style="display: flex;">										
										<select name="category_id" id="categories">
											<option value="">Select a category</option>
											@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ (old('category_id') == $category->id) ? "selected" : "" }}>{{ $category->category_name }}</option>
											@endforeach
										</select>
										<button class="" id="addCat">+</button>
									</div>
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
									<input type="text" class="datepicker" name="published_on" placeholder="Published on" value="{{ old('published_on') ?? date('d-m-Y') }}">
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



<div class="login-wrapper" id="modal_form">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Add Category</h3>
        <form method="post" action="#" id="addCategoryForm">
            @csrf
            <div class="row" id="modalNotify"></div>
        	<div class="row">
        		 <label for="category_name">
                    Category:
                    <input type="text" name="category_name" placeholder="Category*"  />
                </label>
        	</div>
           <div class="row">
           	 <button type="submit" id="addCatSubmit">Submit</button>
           </div>
        </form>
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

		var modal_form = $( "#modal_form" );
		var overlay = $(".overlay");

		//pop up for form
	    $("#addCat").on('click', function(event){
	    	event.preventDefault();

	    	modal_form.parents(overlay).addClass("openform");
			$(document).on('click', function(e){
			var target = $(e.target);
			if ($(target).hasClass("overlay")){
					$(target).find(modal_form).each( function(){
						$(this).removeClass("openform");
					});
					setTimeout( function(){
						$(target).removeClass("openform");
					}, 350);
				}	
			});
	    }); // category modal show



        $("#addCatSubmit").on('click', function(e) {
        	e.preventDefault();

        	var token = $("#addCategoryForm input[name='_token']").val();

    		$.ajax({
    			headers: {
    				'X-CSRF-TOKEN': token
    			},
        		url:"/add-category",
        		type:"post",
        		data: $("#addCategoryForm").serialize(),
        		success: function(res) {
        			if (res.errors) {
        				$("#modalNotify").html(res.errors);
        			} else {
        				var option = "<option value='"+res.category.id+"' selected>"+res.category.category_name+"</option>";
        				$("#categories").append(option);
        				$("#modalNotify").html(res.success);
        				overlay.removeClass("openform");
        				$("#addCategoryForm input[name='category_name']").val('');
        				$("#modalNotify").html("");
        			}
        		}
        	});
        }); // category add using ajax



	});
</script>
@endsection