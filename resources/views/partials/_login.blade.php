<!--login form popup-->
<div class="login-wrapper" id="login-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Login</h3>
        <form method="post" action="#" id="signInForm">
            @csrf
            <div class="row" id="signInNotify"></div>
        	<div class="row">
        		 <label for="username">
                    Email:
                    <input type="email" name="email" id="username" placeholder="Email"  />
                </label>
        	</div>
           
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
                </label>
            </div>
            {{-- <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
					</div>
            		<a href="#">Forget password ?</a>
            	</div>
            </div> --}}
           <div class="row">
           	 <button type="submit" id="signInBtn">Login</button>
           </div>
        </form>
    </div>
</div>
<!--end of login form popup-->
<!--signup form popup-->
<div class="login-wrapper"  id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form action="#" id="signUpForm">
            @csrf
            <div class="row" id="signUpNotify"></div>
            <div class="row">
                 <label for="username-2">
                    Username:
                    <input type="text" name="username" id="" placeholder="Username"  />
                </label>
            </div>
           
            <div class="row">
                <label for="email-2">
                    your email:
                    <input type="email" name="email" id="" placeholder="Email"  />
                </label>
            </div>
             <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" id="password-2" placeholder="Password" autocomplete="off" />
                </label>
            </div>
             <div class="row">
                <label for="repassword-2">
                    Confirm Password:
                    <input type="password" name="confiremd_password" id="repassword-2" placeholder="Confirm Password" autocomplete="off" />
                </label>
            </div>
           <div class="row">
             <button id="signUp" type="submit">sign up</button>
           </div>
        </form>
    </div>
</div>
<!--end of signup form popup-->