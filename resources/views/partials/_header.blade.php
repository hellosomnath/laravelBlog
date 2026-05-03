<header class="ht-header">
	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header logo">
				    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					    <span class="sr-only">Toggle navigation</span>
					    <div id="nav-icon1">
							<span></span>
							<span></span>
							<span></span>
						</div>
				    </div>
				    <a href="index-2.html"><img class="logo" src="{{ asset('assets/images/logo1.png') }}" alt="" style="max-height: 50px"></a>
			    </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav flex-child-menu menu-left">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li><a href="{{ url('/') }}">Home</a></li>
						<li><a href="{{ url('/blogs') }}">Blogs</a></li>
						@if (auth()->user())
						<li><a href="{{ url('/categories') }}">Categories</a></li>
						@endif
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						@if (auth()->user())
							<li class="dropdown first">
								<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
								{{auth()->user()->name}}&nbsp;&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
								</a>
								<ul class="dropdown-menu level1">
									<li><a href="{{ url('/user/my-blogs') }}">My blogs</a></li>
									<li><a href="{{ url('/blogs/create') }}">Write a blog</a></li>
									<li><a href="{{ url('user/profile') }}">Profile</a></li>
									<li class="it-last logout"><a href="{{ url('/logout') }}">Logout</a></li>
								</ul>
							</li> 
						@else						               
							<li class="loginLink"><a href="#">LOG In</a></li>
							<li class="btn signupLink"><a href="#">sign up</a></li>
						@endif
					</ul>
				</div>
			<!-- /.navbar-collapse -->
	    </nav>
	    
	    <!-- top search form -->
	    {{-- <div class="top-search">
	    	<select>
				<option value="united">TV show</option>
				<option value="saab">Others</option>
			</select>
			<input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for">
	    </div> --}}
	</div>
</header>