@extends('layout')

@section('page_title', 'Blog Detail')

@section('content')

@include('partials._hero')

<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="blog-detail-ct">
					<h1>{{ $blog->title }}</h1>
					<p class="time"><span class="ion-ios-calendar-outline"></span> {{date('d-m-Y', strtotime($blog->published_on))}}&nbsp;&nbsp;<span class="ion-ios-person"></span> {{$blog->author}}</p>

					@if ($blog->feature_image)
						<img class="feature_image_single" src="{{ asset($blog->feature_image) }}" alt="">
					@else
						<img class="feature_image_single" src="{{ asset('assets/images/logo1.png') }}" alt="">
					@endif

					<div class="blog-detail-content">{!! $blog->content !!}</div>

					<!-- share link -->
					<div class="flex-it share-tag">
						<div class="social-link">
							<h4>Share it</h4>
							<a href="#"><i class="ion-social-facebook"></i></a>
							<a href="#"><i class="ion-social-twitter"></i></a>
							<a href="#"><i class="ion-social-googleplus"></i></a>
							<a href="#"><i class="ion-social-pinterest"></i></a>
							<a href="#"><i class="ion-social-linkedin"></i></a>
						</div>
						<div class="right-it">
							<h4>Category</h4>
							<a href="{{ url('category/'.$blog->category_name)}}">{{ strtoupper($blog->category_name) }}</a>
							&nbsp;|&nbsp;
							<p style="margin: 0;">Views: {{ $blog->total_views }}</p>
						</div>
					</div>
					<!-- comment items -->
					<div class="comments">
						<h4>{{ sprintf('%02d', $total_comments); }} Comments</h4>
						@if (session()->has('success'))
							<div class="alert alert-info">
								{{ session()->get('success') }}
							</div>
						@endif
						@foreach ($comments as $comment)
							<div class="cmt-item flex-it">
								<div class="author-infor">
									<div class="flex-it2">
										<h6><a href="#"><span class="ion-ios-person"></span> {{ $comment->username }}</a></h6> <span class="time"> <span class="ion-ios-calendar-outline"></span> {{ date('d-m-Y', strtotime($comment->created_at)) }}</span>
									</div>
									<p> {{ $comment->body }}</p>
									<p><a class="rep-btn popup_form" cid="{{ $comment->id }}" href="#">+ Reply</a></p>
								</div>
							</div>
							@if ($comment['subcomment'])
								@foreach ($comment['subcomment'] as $subcomment)
									<div class="cmt-item flex-it reply">
										<div class="author-infor">
											<div class="flex-it2">
												<h6><a href="#"><span class="ion-ios-person"></span> {{ $subcomment->username }}</a></h6> <span class="time"> <span class="ion-ios-calendar-outline"></span> {{ date('d-m-Y', strtotime($subcomment->created_at)) }}</span>
											</div>
											<p> {{ $subcomment->body }}</p>
										</div>
									</div>
								@endforeach
							@endif
						@endforeach
						{{ $comments->links() }}
					</div>
					<div class="comment-form">
						<h4>Leave a comment</h4>
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
						<form action="{{ url('comment') }}" method="post">
							@csrf
							<input type="hidden" name="blog_id" value="{{ $blog->id }}">
							<div class="row">
								<div class="col-md-4">
									<input type="text" name="username" value="{{ old('username') }}" placeholder="Your name*">
								</div>
								<div class="col-md-4">
									<input type="email" name="email" value="{{ old('email') }}" placeholder="Your email*">
								</div>
								<div class="col-md-4">
									<input type="text" name="website" value="{{ old('website') }}" placeholder="Website">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<textarea  name="body" id="" placeholder="Message*">{{ old('body') }}</textarea>
								</div>
							</div>
							<input class="submit" type="submit" placeholder="submit">
						</form>
					</div>
					<!-- comment form -->
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
						<h4 class="sb-title">Categories</h4>
						<div class="top-search">
							<select onchange="window.location.href='/category/' + this.value;">
								<option value="">Select a category</option>
								@foreach($categories as $category)
								<option value="{{ $category->category_name }}">{{ strtoupper($category->category_name) . ' (' . $category->blogs_count . ')' }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="sb-recentpost sb-it">
						<h4 class="sb-title">most popular</h4>
						@for ($i = 0; $i < 3; $i++)
						<div class="recent-item">
							@if (!empty($popular_blogs[$i]))
							<span>{{ $i+1 }}</span><h6><a href="{{ url('/blogs/' . $popular_blogs[$i]->id) }}">{{ $popular_blogs[$i]->title }}</a></h6>
							@endif
						</div>
						@endfor
					</div>
					<div class="sb-recentpost sb-it">
						<h4 class="sb-title">most recent</h4>
						@for ($i = 0; $i < 3; $i++)
						<div class="recent-item">
							@if (!empty($latest_blog[$i]))
							<span>{{ $i+1 }}</span><h6><a href="{{ url('/blogs/' . $latest_blog[$i]->id) }}">{{ $latest_blog[$i]->title }}</a></h6>
							@endif
						</div>
						@endfor
					</div>
					<div class="sb-tags sb-it">
						<h4 class="sb-title">tags</h4>
						@php
						$tags = explode(',', $blog->tags);
						@endphp
						<ul class="tag-items">
							@foreach ($tags as $tag)
							<li><a href="{{ url('/tags/'. strtolower(trim($tag))) }}">{{ trim($tag) }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- reply comment modal --}}
<div class="login-wrapper" id="modal_form">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Reply</h3>
        <form method="post" action="#" id="replyCommentForm">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <input type="hidden" name="parent_id" id="replyCommentParent" value="0">
            <div class="row" id="modalNotify"></div>
        	<div class="row">
        		 <label for="username">
                    Name:
                    <input type="text" name="username" placeholder="Name*"  />
                </label>
        	</div>
        	<div class="row">
        		 <label for="email">
                    Email:
                    <input type="email" name="email" placeholder="Email*"  />
                </label>
        	</div>
        	<div class="row">
        		 <label for="website">
                    Website:
                    <input type="text" name="website" placeholder="Website"  />
                </label>
        	</div>
        	<div class="row">
        		 <label for="message">
                    Message:
                    <textarea name="body" placeholder="Message*" style="min-height: 50px;"></textarea>
                </label>
        	</div>
           <div class="row">
           	 <button type="submit" id="replySubmit">Submit</button>
           </div>
        </form>
    </div>
</div>

@endsection

@section('custom-scripts')
<script>
	$(document).ready(function() {
		var modal_form = $( "#modal_form" );
		var overlay = $(".overlay");

		//pop up for form
	    $(".popup_form").on('click', function(event){
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
	    });

	    $(".rep-btn").on('click', function() {
	    	var cid = $(this).attr('cid');
	    	$("#replyCommentParent").val(cid);
	    });

	    $("#replySubmit").on('click', function(e) {
	    	e.preventDefault();

	    	var token = $("#replyCommentForm input[name='_token']").val();

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': token
				},
	    		url:"/reply-comment",
	    		type:"post",
	    		data: $("#replyCommentForm").serialize(),
	    		success: function(res) {
	    			if (res.errors) {
	    				$("#modalNotify").html(res.errors);
	    			} else {
	    				$("#modalNotify").html(res.success);
	    				window.location.href = res.url;
	    			}
	    		}
	    	});
	    });


	});
</script>
@endsection