<footer class="ht-footer">
	<div class="container">
		<div class="flex-parent-ft">
			<div class="flex-child-ft item1">
				 <a href="index-2.html"><img class="logo" src="{{ asset('assets/images/logo1.png') }}" alt="" style="max-height: 75px;"></a>
				 <p>Kolkata, West Bengal</p>
			</div>
			<div class="flex-child-ft item2">
				<h4>Resources</h4>
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ url('/blogs') }}">Blogs</a></li>
					@if (auth()->user())
					<li><a href="{{ url('/categories') }}">Categories</a></li>
					@endif
				</ul>
			</div>
			<div class="flex-child-ft item3">
				
			</div>
			<div class="flex-child-ft item4">
				@if (auth()->user())
				<h4>Account</h4>
				<ul>
					<li><a href="{{ url('/user/my-blogs') }}">My blogs</a></li>
					<li><a href="{{ url('/blogs/create') }}">Write a blog</a></li>
					<li><a href="{{ url('user/profile') }}">Profile</a></li>
					<li class="it-last logout"><a href="{{ url('/logout') }}">Logout</a></li>
				</ul>
				@endif
			</div>
			<div class="flex-child-ft item5">
				
			</div>
		</div>
	</div>
	<div class="ft-copyright">
		<div class="ft-left">
			&copy; LaravelBlog, {{ date('Y') }}
		</div>
		<div class="backtotop">
			<p><a href="#" id="back-to-top">Back to top  <i class="ion-ios-arrow-thin-up"></i></a></p>
		</div>
	</div>
</footer>