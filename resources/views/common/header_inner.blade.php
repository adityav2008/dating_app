<header class="head pro-head">
	<div class="container">
		<div class="row">
			<div class="logo col-lg-3">
				<a href="index.html"><img src="{{Request::root()}}/assets/frontend/img/logo2.png" alt="" /></a>
			</div>
			<div class="head-right col-lg-9">
				<div class="notifications">
					<a href="#">
						<i class="fa fa-heart" aria-hidden="true"></i>
						<span class="count">2</span>
					</a>
					<a href="#">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span class="count">3</span>
					</a>
				</div>
				<div class="profile-show">
					<div class="chat-icon pull-right">
						<a href="#">
							<i class="fa fa-wechat" aria-hidden="true"></i>
							<span class="count">3</span>
						</a>
					</div>
					<?php
				    $values = DB::table('manage_users')->where('id',array(Session::get('id')))->first();
				    ?>
					<div class="dropdown pull-right">
						<button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
							<div class="img">
								<div class="inner">
									<img src="{{url('/images')}}/{{ $values->image }}" alt="" height="46px" width="46px" />
								</div>
							</div>
							<div class="text">
								<h6>{{ $values->name }}</h6>
								<p>{{ $values->age }},{{ $values->state }} </p>
								<span class="caret"></span>
							</div>
						</button>
						<ul class="dropdown-menu">
							<li><a href="{{ url('/profile?id=') }}{{ Session::get('id') }}">My Profile</a></li>
							<li><a href="{{ url('/account-setting') }}/{{ Session::get('id') }}">Account Setting</a></li>
							<li><a href="{{ url('header_inner') }}">Sign Out</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</header>
