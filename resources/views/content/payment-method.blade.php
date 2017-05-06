@extends('layout/layout')
@include('common/header_inner')
@section('content')
<link href="{{Request::root()}}/assets/frontend/css/accoount.css" rel="stylesheet" type="text/css" />
<section class="main-content middle-container account-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				@include('common.account-sidebar')
			</div>
			<div class="col-lg-9">
				<article class="col-lg-9 main-right">
						<div class="panel-group">
								<div class="panel panel-default pay-methods">
										<div class="panel-heading">Payment Methods</div>
										<div class="panel-body">
												<div class="add-payment">
														<ul>
																<li class="clearfix">
																		<p>xxxxxxxxxxxxx7535 <br/>05/2019</p>
																		<div class="wrap">
																				<div class="pull-left">
																						<a href="#">Set Default</a>
																						<a href="#">Remove</a>
																				</div>
																				<div class="pull-right">
																						<img src="{{Request::root()}}/assets/frontend/img/visa-icon.png" alt="" />
																				</div>
																		</div>
																</li>
																<li class="center">
																		<center><img src="{{Request::root()}}/assets/frontend/img/add-plus.png" alt="" /></center>
																		<p>Add Payment Method</p>
																</li>
														</ul>
												</div>
												<p>Remember: Airbnb will never ask you to wire money. <a href="#">Learn more</a>.</p>
										</div>
								</div>
						</div>
				</article>
			</div>
		</div>
	</div>
</section>
@endsection
