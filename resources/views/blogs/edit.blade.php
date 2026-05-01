@extends('layout')

@section('page_title', 'Edit Blog')

@section('content')
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="blog-detail-ct">
					<div class="comment-form">
						<h4>Edit Blog</h4>
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
		</div>
	</div>
</div>
@endsection