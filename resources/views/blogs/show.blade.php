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
						</div>
					</div>
					<!-- comment items -->
					<div class="comments">
						<h4>{{ sprintf('%02d', $total_comments); }} Comments</h4>
						@foreach ($comments as $comment)
							<div class="cmt-item flex-it">
								<div class="author-infor">
									<div class="flex-it2">
										<h6><a href="#"><span class="ion-ios-person"></span> {{ $comment->username }}</a></h6> <span class="time"> <span class="ion-ios-calendar-outline"></span> {{ date('d-m-Y', strtotime($comment->created_at)) }}</span>
									</div>
									<p> {{ $comment->body }}</p>
									<p><a class="rep-btn" href="#">+ Reply</a></p>
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
						<form action="#">
							<div class="row">
								<div class="col-md-4">
									<input type="text" placeholder="Your name">
								</div>
								<div class="col-md-4">
									<input type="text" placeholder="Your email">
								</div>
								<div class="col-md-4">
									<input type="text" placeholder="Website">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<textarea name="message" id="" placeholder="Message"></textarea>
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
@endsection