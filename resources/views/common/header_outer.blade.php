<!-- Modal -->

<div id="myModal" class="modal fade login-pop" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><img src="{{Request::root()}}/assets/frontend/img/close-btn.png" alt="" /></button>
        <div class="signin div_login">
					<h3>Log In</h3>
					<p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
					<ul class="with-login">
						<li><a  href="{{Request::root()}}/auth/facebook"><i></i>Facebook</a></li>
						<li><a class="tww" href="{{Request::root()}}/auth/twitter"><i class="tw"></i>Twitter</a></li>
						<li><a class="g-plus" href="{{Request::root()}}/auth/google"><i class="g"></i>Google +</a></li>
						<div class="clear"> </div>
					</ul>
					<h5>OR</h5>
					<form action="{{ url('/header_outer') }}" method="post">
            {!! csrf_field() !!}
            <input id="email" type="email" class="email" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
						<input type="submit" value="Sign in">
					</form>
					<div class="lost-top">
						<p><a id="recover" href="#">Recover your password<i></i></a></p>
					</div>
				</div>

				<div class="signin recover">
						<h3>Recover Password</h3>
					 <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
						<form action="#" method="post">
							<input placeholder="Email" name="Email" required="" type="text">
							<input value="Submit Reset" type="submit">
						</form>
						<div class="lost-top">
								<p><a id="go-back" href="#"><i class="left-arrow"></i>Cancel and go back to Login page</a></p>
						</div>
					</div>

				<!--<div class="signin sign-in">
					<h3>Reset Password</h3>
					<p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
					<form action="#" method="post">
						<input placeholder="Password" name="Password" required="" type="password">
						<input placeholder="Repeat Password" name="Repeat Password" required="" type="password">
						<input value="Update Password" type="submit">
					</form>
				</div>-->
			</div>
	</div>
</div>

<header class="head">

	<div class="container">

		<div class="row">

			<div class="logo pull-left">
			<a href="{{url('/index')}}">
				<img src="{{Request::root()}}/assets/frontend/img/logo.png" alt="" />
				</a>
			</div>

			<div class="head-right pull-right">

				<div class="login">

					<a onClick="showLogin()"><i class="fa fa-user" aria-hidden="true"></i> Login</a>

				</div>

				<nav class="navi">

					<div id='cssmenu'>

						<ul>

						    <li><a href="{{url('/about')}}">About Us</a></li>

						    <li><a href='#'>FAQs</a></li>

						    <li><a href='{{url('/contact')}}'>Contact Us</a></li>

						</ul>

					</div>

				</nav>

			</div>

		</div>

	</div>

</header>
