@extends('layout/layout')

@include('common/header_inner')

@section('content')

<section class="main-content">

	<div class="container">

		<div class="row">

			<div class="col-lg-3">

				@include('common.sidebar')

			</div>

			<div class="col-lg-9">

				<div class="heading-sec1">

					<h2>Your Dating Profile</h2>

				</div>

				<div class="profile-main">

					<div class="profile-pic pull-left">

						<div class="pro-pic">

							<img src="{{Request::root()}}/assets/frontend/img/profile-pic.jpg" alt="" />

						</div>

						<div class="tow-btn">

							<ul class="clearfix">

								<li class="pull-left">

									<a class="grey-btn" href="#">Add Photo <i class="fa fa-photo" aria-hidden="true"></i></a>

								</li>

								<li class="pull-right">

									<a class="grey-btn" href="#">Edit Photos <i class="fa fa-edit" aria-hidden="true"></i></a>

								</li>

							</ul>

						</div>

						<div class="add-samll-pic">

							<img src="{{Request::root()}}/assets/frontend/img/small-profile-pic.jpg" alt="" />

						</div>

					</div>

					<div class="profile-right pull-right">

						<div class="edit-big-btn">

							<p>Jasmine lee</p>

							<span><a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a></span>

						</div>

						<div class="edit-big-btn">

							<p>27 Years Old</p>

							<span><a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a></span>

						</div>

						<div class="edit-big-btn">

							<p>Australia</p>

							<span><a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a></span>

						</div>

						<div class="members">

							<h4>Members receive an average of 3 times more views while they Boost.</h4>

							<div class="member-pic">

								<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />

								<div class="member-single-pic">

									<img src="{{Request::root()}}/assets/frontend/img/member-single-pic.jpg" alt="" />

								</div>

							</div>

							<h4>Want more views? Get 75 Boost!</h4>

							<a href="#" class="btn2"><i class="fa fa-gg-circle" aria-hidden="true"></i> 150 Coins</a>

						</div>

					</div>

					<div class="clearfix"></div>

				</div>

				<div class="verifi-main">

					<div class="heart-heading">

						<h3>Verification</h3>

					</div>

					<h4>Improve your reputation in just a few seconds!</h4>

					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>

					<ul>

						<li class="clearfix">

							<span class="pull-left"><i class="fa fa-photo" aria-hidden="true"></i>Photo Verification</span>

							<button class="btn2">Verify Now</button>

						</li>

						<li class="clearfix">

							<span class="pull-left"><i class="fa fa-phone-square" aria-hidden="true"></i>Phone Number</span>

							<button class="btn2">Verify Now</button>

						</li>

						<li class="clearfix">

							<span class="pull-left"><i class="fa fa-facebook-square" aria-hidden="true"></i>Facebook Verified</span>

							<button class="btn2">Verify Now</button>

						</li>

						<li class="clearfix">

							<span class="pull-left"><i class="fa fa-twitter-square" aria-hidden="true"></i>Twitter</span>

							<button class="btn2">Verify Now</button>

						</li>

					</ul>

				</div>

				<div class="basics-story">

					<div class="basics">

						<div class="heart-heading">

							<h3>Basics</h3>

							<a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>

						</div>

						<ul>

							<li class="clearfix">

								<strong>Sign:</strong> <span>Sagittarius</span>

							</li>

							<li class="clearfix">

								<strong>Height:</strong> <span>5'9" / 174 cm</span>

							</li>

							<li class="clearfix">

								<strong>Ethnicity:</strong> <span>Australia</span>

							</li>

							<li class="clearfix">

								<strong>Body Type:</strong> <span>Athletic</span>

							</li>

							<li class="clearfix">

								<strong>Children:</strong> <span>No children</span>

							</li>

							<li class="clearfix">

								<strong>Education:</strong> <span>Advanced degree</span>

							</li>

							<li class="clearfix">

								<strong>Religion:</strong> <span>Christian</span>

							</li>

							<li class="clearfix">

								<strong>Industry:</strong> <span>Tell you later</span>

							</li>

							<li class="clearfix">

								<strong>Income:</strong> <span>Less than Ras200000</span>

							</li>

						</ul>

					</div>

					<div class="basics story">

						<div class="heart-heading">

							<h3>Story</h3>

							<a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>

						</div>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

					</div>

					<div class="clearfix"></div>

				</div>

				<div class="basics-story romance">

					<div class="heart-heading">

						<h3>Romance</h3>

					</div>

					<div class="basics">

						<div class="heart-heading">

							<h3>Perfect Match</h3>

							<a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>

						</div>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

					</div>

					<div class="basics story">

						<div class="heart-heading">

							<h3>Ideal Date</h3>

							<a href="#">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>

						</div>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

						<h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>

						<img src="{{Request::root()}}/assets/frontend/img/dummy-text-img.png" alt="" />

					</div>



					<div class="clearfix"></div>

				</div>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript">

$(document).ready(function(){

	$('.bxslider').bxSlider({

		mode: 'fade',

		captions: false

	});

});

</script>

@stop

