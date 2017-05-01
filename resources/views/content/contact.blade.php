@extends('layout/layout')

@include('common/header_outer')

@section('content')

<div class="banner inner-banner">

	<img src="{{Request::root()}}/assets/frontend/img/contact-banner.jpg" alt="" />

	<div class="bread-main">

		<div class="container">

			<div class="row">

				<ol class="breadcrumb">

					<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

					<li class="breadcrumb-item active">Library</li>

				</ol>

			</div>

		</div>

	</div>

</div>

<section class="contact-us">

	<div class="container">

		<div class="row">

			<div class="col-md-5 map">

				<h4>Location</h4>

				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d12467.649723041844!2d-90.19720769421387!3d38.6278955486419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1476947694514" allowfullscreen="" height="450" width="600"></iframe>

			</div>

			<div class="col-md-4 get-in">

				<h4>Get in touch</h4>

				<div class="feild">

					<input type="text" placeholder="Name" />

				</div>

				<div class="feild">

					<input class="icon2" type="mail" placeholder="Email" />

				</div>

				<div class="feild">

					<textarea placeholder="Type your message..." class="icon3"></textarea>

				</div>

				<input type="submit" class="btn2" value="Send Message" />

			</div>

			<div class="col-md-3">

				<h4>Contact Info</h4>

				<ul class="contact-info">

					<li><span>Address:</span>123 New Design Str, ABC building, Melbourne, Australia.</li>

					<li><span>Phone:</span>(0045) 5763 0584 678 </li>

					<li><span>Email:</span>dating@mail.com </li>

				</ul>

				<h4>Working Hours</h4>

				<ul class="working-hours">

					<li><span>09:00 - 19:00</span>Monday - Friday: </li>

					<li><span>09:00 - 15:00</span>Saturday: </li>

					<li><span>Closed</span>Sunday: </li>

				</ul>

				<div class="socials">

					<h4>Get Social</h4>

					<ul>

						<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

						<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

						<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

						<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

</section>

@stop

