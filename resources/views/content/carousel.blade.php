@extends('layout/layout')
@include('common/header_inner')
@section('content')
<section class="main-content carousel">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				@include('common/sidebar')
			</div>
			<div class="col-lg-9">
				<div class="carousel-right">
					<div id="tabs">
						<div class="row">
							<ul>
								<li><a href="#tabs-1">Meet</a></li>
								<li><a href="#tabs-2">Matches</a></li>
							</ul>
						</div>
						<div id="tabs-1">
							<div class="meet">
								<h3>Want to meet her?</h3>
								<?php
			     					$values = DB::table('manage_users')->whereNotIn('id',array($_GET['id']))->get();
			     					?>
								<div class="container">
									<div class="hub-slider">
										<div class="hub-slider-slides">
											<ul>
											@foreach($values as $result)
												<li>
													<img src="{{url('/images')}}/{{ $result->image }}" alt="" height="280px" width="300px" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 1</span>
														<span class="age pull-right">Age: {{$result->age}}</span>
													</div>
												</li>
											@endforeach	
											</ul>
										</div>
										<div class="hub-slider-controls">
											<button class="hub-slider-arrow hub-slider-arrow_next pull-left">
												<img src="{{Request::root()}}/assets/frontend/img/prev-button.png" alt="" />
												<span>No</span>
											</button>
											<button class="hub-slider-arrow hub-slider-arrow_prev pull-right">
												<img src="{{Request::root()}}/assets/frontend/img/next-button.png" alt="" />
												<span>Yes</span>
											</button>
										</div>
									</div>
								</div>
								<a class="grey-btn" href="#"><i aria-hidden="true" class="fa fa-circle-o"></i> MAYBE</a>
							</div>
						</div>
						<div id="tabs-2">
							<div class="meet">
								<h3>Want to meet her?</h3>
								<div class="container">
									<div class="hub-slider">
										<div class="hub-slider-slides2">
											<ul>
												<li>
													<img src="{{Request::root()}}/assets/frontend/img/nice-pic2.jpg" alt="" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 5</span>
														<span class="age pull-right">Age: 25</span>
													</div>
												</li>
												<li>
													<img src="{{Request::root()}}/assets/frontend/img/nice-pic.jpg" alt="" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 5</span>
														<span class="age pull-right">Age: 25</span>
													</div>
												</li>
												<li>
													<img src="{{Request::root()}}/assets/frontend/img/nice-pic2.jpg" alt="" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 5</span>
														<span class="age pull-right">Age: 25</span>
													</div>
												</li>
												<li>
													<img src="{{Request::root()}}/assets/frontend/img/nice-pic.jpg" alt="" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 5</span>
														<span class="age pull-right">Age: 25</span>
													</div>
												</li>
											</ul>
										</div>
										<div class="hub-slider-controls">
											<button class="hub-slider-arrow hub-slider-arrow_next pull-left">
												<img src="{{Request::root()}}/assets/frontend/img/prev-button.png" alt="" />
												<span>No</span>
											</button>
											<button class="hub-slider-arrow hub-slider-arrow_prev pull-right">
												<img src="{{Request::root()}}/assets/frontend/img/next-button.png" alt="" />
												<span>Yes</span>
											</button>
										</div>
									</div>
								</div>
								<a class="grey-btn" href="#"><i aria-hidden="true" class="fa fa-circle-o"></i> MAYBE</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(document).ready(function(){
	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: false
	});
});

$('.hub-slider-slides ul').hubSlider({
  selector: $('li'),
  button: {
    next: $('.hub-slider-arrow_next'),
    prev: $('.hub-slider-arrow_prev')
  },
  transition: '0.7s',
  startOffset: 30,
  auto: false,
  time: 2 // secondly
});
$('.hub-slider-slides2 ul').hubSlider({
  selector: $('li'),
  button: {
    next: $('.hub-slider-arrow_next'),
    prev: $('.hub-slider-arrow_prev')
  },
  transition: '0.7s',
  startOffset: 30,
  auto: false,
  time: 2 // secondly
});



$(function() {
$( "#tabs" ).tabs();
});
</script>
@stop
