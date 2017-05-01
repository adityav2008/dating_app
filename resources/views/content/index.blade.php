@extends('layout/layout')
@include('common/header_outer')
@section('content')
<div class="banner">
	<ul class="bxslider">
		<li>
			<div class="banner-txt">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 banner-form">
							<div class="sign-up">
								<ul>
									<li><a href="#"><img src="{{Request::root()}}/assets/frontend/img/sign-facebook.png" alt="" /></a></li>
									<li><a href="#"><img src="{{Request::root()}}/assets/frontend/img/sign-tiwtter.png" alt="" /></a></li>
									<li><a href="#"><img src="{{Request::root()}}/assets/frontend/img/sign-google-plus.png" alt="" /></a></li>
								</ul>
							</div>
						<!-- Prashant kumar 12 Apr 2017 -->
							<form method="POST" action="{{url('/index')}}">
							 {{csrf_field()}}
							<div class="form-contanier">
								<div class="feild">
									<label>I am a</label>
									<select name="gender">
										<option selected>Select Gender</option>
										<option value="male">Man</option>
										<option value="female">Woman</option>
									</select>
								</div>
								<div class="feild">
									<label>Looking for a</label>
									<select name="looking_for">
										<option selected>Select Gender</option>
										<option value="male">Man</option>
										<option value="female">Woman</option>
									</select>
								</div>
								<div class="feild">
									<label>Birthday</label>
									<ul>
										<li class="month">
											<select name="month">
												<option selected>Month</option>
												<option value='1'>Janaury</option>
												<option value='2'>February</option>
												<option value='3'>March</option>
												<option value='4'>April</option>
												<option value='5'>May</option>
												<option value='6'>June</option>
												<option value='7'>July</option>
												<option value='8'>August</option>
												<option value='9'>September</option>
												<option value='10'>October</option>
												<option value='11'>November</option>
												<option value='12'>December</option>
											</select>
										</li>
										<li class="day">
											<select name="day">
												<option selected>Day</option>
												@for ($i = 1; $i <= 31 ; $i++)
		                                        <option value="{{ $i }}"> {{ $i }} </option>
		                                        @endfor 
											</select>
										</li>
										<li class="year">
											<select id="birthyear" name="year">
											{{ $currentYear = date('Y')-1 }}
									        @foreach (range($currentYear,1950) as $value) 
									          <option> {{$value}} </option >
									        @endforeach
											</select>
										</li>
									</ul>
								</div>
								<div class="feild">
									<label>Email</label>
									<input type="mail" name="email" placeholder="Enter your mail id" />
								</div>
								<div class="feild">
									<label>Password</label>
									<input type="mail" name="password" placeholder="Enter password" />
								</div>
								<input type="submit" class="btn2" value="Sign Up" />
							</div>
							</form>
							<!-- prashant kumar 12 apr 2017 -->
						</div>
					</div>
				</div>
			</div>
			<img src="{{Request::root()}}/assets/frontend/img/banner1.jpg" alt="" />
		</li>
	</ul>
</div>
<section class="sweet-stories">
	<div class="container">
		<div class="row">
			<h2>Sweet stories <span>Lovers</span></h2>
			<p>Here you have some success stories from our blog section. Lorem ipsum dolor sit amet, consectetur adipisicing <br/>elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			<ul class="clearfix">
				<li>
					<div class="img">
						<img src="{{Request::root()}}/assets/frontend/img/one-third-img1.jpg" alt="" />
					</div>
					<div class="content">
						<h4>Lorem ipsum dolor sit amet</h4>
						<p>Relationships are made up of defining moments, both big and small. Some love stories hit...</p>
						<a href="#">Read More</a>
					</div>
				</li>
				<li>
					<div class="img">
						<img src="{{Request::root()}}/assets/frontend/img/one-third-img2.jpg" alt="" />
					</div>
					<div class="content">
						<h4>Lorem ipsum dolor sit amet</h4>
						<p>Relationships are made up of defining moments, both big and small. Some love stories hit...</p>
						<a href="#">Read More</a>
					</div>
				</li>
				<li>
					<div class="img">
						<img src="{{Request::root()}}/assets/frontend/img/one-third-img3.jpg" alt="" />
					</div>
					<div class="content">
						<h4>Lorem ipsum dolor sit amet</h4>
						<p>Relationships are made up of defining moments, both big and small. Some love stories hit...</p>
						<a href="#">Read More</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>
@stop
