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

							@if (session()->has('success'))
								<div class="alert alert-info">
									{{ session()->get('success') }}
								</div>	
							@endif
						</div>
						<form method="post" action="{{ url('user/profile/' . auth()->user()->id)}}" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{ auth()->user()->id }}">
							<div class="row">
								<div class="col-md-6">
									<label for="">Name*</label>
									<input type="text" name="username" placeholder="Name" value="{{ old('username') ?? auth()->user()->name }}">
								</div>
								<div class="col-md-6">
									<label for="">Email*</label>
									<input type="email" name="email" placeholder="Email" value="{{ old('email') ?? auth()->user()->email }}">
								</div>
							</div>
							<div class="row reset-password">
								<h5>Reset Password</h5>
								<hr>
								<div class="col-md-4">
									<label for="">Current Password*</label>
									<input type="password" name="current_password" placeholder="Current Password" autocomplete="off">
								</div>
								<div class="col-md-4">
									<label for="">New Password*</label>
									<input type="password" name="new_password" placeholder="New Password" autocomplete="off">
								</div>
								<div class="col-md-4">
									<label for="">Confirm Password*</label>
									<input type="password" name="confirm_password" placeholder="Confrim Password" autocomplete="off">
								</div>
								<em class="text-warning">* you'll be logged out after reset password.</em>
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