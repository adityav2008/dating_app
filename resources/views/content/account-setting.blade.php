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
								<div class="panel panel-default push-noti">
										<div class="panel-heading">Notification Settings</div>
										<div class="panel-body">
												<div class="media">
														<div class="media-body">
																<div class="checkbox-him">
																		<div class="row">
																				<label class="col-sm-1">
																						<input id="new" type="checkbox">
																				</label>
																				<label for="new" class="col-sm-11">
																						<strong>Email</strong>
																				</label>
																		</div>
																</div>
																<div class="checkbox-him">
																		<div class="row">
																				<label class="col-sm-1">
																						<input id="new" type="checkbox">
																				</label>
																				<label for="new" class="col-sm-11">
																						<strong>Text Messages</strong>
																				</label>
																		</div>
																</div>
														</div>
												</div>
										</div>
								</div>

						</div>
				</article>
			</div>
		</div>
	</div>
</section>
@endsection
