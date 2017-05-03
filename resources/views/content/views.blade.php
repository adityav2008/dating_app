
@extends('layout/layout')

@include('common/header_inner')

@section('content')
<section class="main-content connections views">
	<div class="container">
		<div class="row">

		     <div class="col-lg-3">

               @include('common/sidebar')

		      </div>

			<div class="col-lg-9">


				<div class="heading-sec1">
					<div class="grid-view">
						<div class="grid-list pull-left">
							<h2>Recent Online</h2>
						</div>

						<div class="clearfix"></div>
					</div>
				</div>

				<div class="connections-right">
					<div class="tab-slider">
						<ul class="bxslider">
							<li>
								<div class="slider-main">
									<div class="slider-wrapper">
										<div class="left-img pull-left">
											<img src="{{Request::root()}}/assets/frontend/img/profile-pic-boy.jpg" alt="" />
										</div>
										@foreach($result as $values)
										
										<div class="right-content pull-right" id="{{ $values->id }}">
											<div class="green-btn"><i aria-hidden="true" class="fa fa-circle"></i> Recently Online</div>
											<input type="hidden" id="viewer" value="{{ $values->id }}">
											<h5>{{ $values->name }}</h5>
											<p>Viewed you: 1 day ago</p>
											<a href="{{url('/profile-about?id='.$values->id)}}" class="grey-btn" id="view">View Profile</a>
											<a href="#" class="report">Delete - Report/Block</a>
										</div>
										<div class="clearfix"></div>
										
									</div>
								</div>
							</li>
						</ul>
						<div class="outside">
							@endforeach
							<p>{{ $result->appends(['id'=> $values->id])->links() }}</p>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	

$(document).ready(function(){
	$('.bxslider').bxSlider({
		nextSelector: '#slider-next',
		prevSelector: '#slider-prev',
		nextText: 'Next',
		prevText: 'Prev'
	});
	$('.bxslider2').bxSlider({
		nextSelector: '#slider-next2',
		prevSelector: '#slider-prev2',
		nextText: 'Next',
		prevText: 'Prev'
	});


});
</script>>
@stop