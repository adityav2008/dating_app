@extends('layout/layout')

@include('common/header_inner')

@section('content')

<section class="main-content messages">

	<div class="container">

		<div class="row">

			<div class="col-lg-3">

        @include('common/sidebar')

			</div>

			<div class="col-lg-9">

				<div class="heading-sec1">

					<div class="dropdown pull-left">

						<button class="btn2 btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Unread

						<span class="caret"></span></button>

						<ul class="dropdown-menu">

							<li><a href="#">All Incoming </a></li>

							<li class="divider"></li>

							<li><a href="#">Unread</a></li>

							<li class="divider"></li>

							<li><a href="#">Conversations</a></li>

							<li class="divider"></li>

							<li><a href="#">Sent</a></li>

							<li class="divider"></li>

							<li><a href="#">Initial Winks</a></li>

							<li class="divider"></li>

							<li><a href="#">Initial Messages</a></li>

						</ul>

					</div>

					<div class="delete-btn pull-right">

						<a href="#" class="grey-btn">Edit <i class="fa fa-trash-o" aria-hidden="true"></i></a>

					</div>

					<div class="clearfix"></div>

				</div>

				<div class="profile-main">

					<div class="massage-icon">

						<img src="{{Request::root()}}/assets/frontend/img/big-mail-icon.png" alt="" />

						<h2>You don't have any messages that match this filter</h2>

					</div>

					<div class="members">

						<h4>Boost Your Visibility</h4>

						<p>Members receive an average of 3 times more views while they Boost.</p>

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

			</div>

		</div>

	</div>

</section>

@stop

