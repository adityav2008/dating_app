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

								<div class="container">
									<div class="hub-slider">
									<?php
											$return = DB::table('manage_users')
								                    ->whereNotIn('id',array(Session::get('id')))
								                    ->where('status','!=',0)
								                    ->get(); 
											 ?>
											@foreach($return as $result)
										<div class="hub-slider-slides">
										
											<ul>
											
												<li>
													<img src="{{url('/images')}}/{{ $result->image }}" alt="" height="280px" width="300px" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 1</span>
														<span id="hidden_id" value="{{$result->id }}" class="photo pull-left">Unique Id : {{ $result->id }}</span>
														<span class="age pull-right">Age: {{$result->age}}</span>
													</div>
												</li>
												</ul>
											@endforeach	
											
										</div>
										<div class="hub-slider-controls">

											<button id="no" class="hub-slider-arrow hub-slider-arrow_next pull-left">
												<img src="{{Request::root()}}/assets/frontend/img/prev-button.png" alt="" />
												<span>No</span>
											</button>

											<button id="yes" class="hub-slider-arrow hub-slider-arrow_prev pull-right">
												<img src="{{Request::root()}}/assets/frontend/img/next-button.png" alt="" />
												<span>Yes</span>
											</button>

										</div>
									</div>
								</div>
								<a class="grey-btn" ><i aria-hidden="true" class="fa fa-circle-o"></i> MAYBE</a>
							</div>
						</div>
						<div id="tabs-2">
							<div class="meet">
								<h3>Want to meet her?</h3>
								<div class="container">
									<div class="hub-slider">
										<div class="hub-slider-slides2">
											<ul>
											<?php
											$filter = DB::table('user_search')->where('user_id',Session::get('id'))->get();

											//$filter = DB::table('user_search')->where('user_id',$_GET['id'])->get();
											
											if(isset($filter) || empty($filter))
											{
												foreach ($filter as $value) 
												{

													$res_for   = $value->looking_for;
													$res_fromAge   = $value->from_age;
													$res_toAge   = $value->to_age;
													$res_location   = $value->location;
													$res_fromHeight   = $value->from_height;
													$res_toHeight   = $value->to_height;
													$res_relationship   = $value->relationship;
													$res_children   = $value->children;
													$res_education   = $value->education;
													$res_ethnicity   = $value->ethnicity;
													$res_religion   = $value->religion;
													$res_bodyType   = $value->body_type;
													$res_smoke   = $value->smoking;
													$res_search   = $value->search_name;
												}

											if(!empty($filter))
											{
										     	$matches = DB::table('manage_users')
										                ->whereNotIn('id',array(Session::get('id')))
										                ->where('status','!=',0)
										                ->get();
											}
											else
											{
										    	$matches = DB::table('manage_users')
											            ->whereNotIn('id',array(Session::get('id')))
											            ->where('looking_for',$res_for)
											            ->whereBetween('age', array( $res_fromAge, $res_toAge))
											            ->whereBetween('height', array( $res_fromHeight, $res_toHeight))
											            ->where('relationship',$res_relationship)
											            ->where('children',$res_children)
											            ->where('education',$res_education)
											            ->where('ethnicity',$res_ethnicity)
											            ->where('religion',$res_religion)
											            ->where('body_type',$res_bodyType)
											            ->where('smoking',$res_smoke)
											            ->get();
										    }
											    
										
											 ?>
											@foreach($matches as $match)
												<li>
													<img src="{{url('/images')}}/{{ $match->image }}" alt="" height="280px" width="300px" />
													<div class="photo-age">
														<span class="photo pull-left">Photo 1</span>
														<span class="age pull-right">Age: {{$match->age}}</span>
													</div>
												</li>
											@endforeach	
											</ul>
											<?php
										}
										?>
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
								<a class="grey-btn" id="yes"><i aria-hidden="true" class="fa fa-circle-o"></i> MAYBE</a>
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

	// request profile to get connected
		$("#yes").click(function(){
			var user_idss = $('#hidden_id').val();
			var send_by = "{{Session::get('id')}}";
			alert(user_idss);
			alert(send_by);
			// var msg = $('#msg').val();
			// Returns successful data submission message when the entered information is stored in database.
			if(user_idss == '' || send_by == '' )
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"carousel",
                    dataType:'json',
                    data:{ 
                    		messenger_id : send_by,
                    		manage_users_id : user_idss,
                    	  	action : 'request',
                    	  	_token:'{{csrf_token()}}'
                    	 },
                    success: function(result){
                    	if(result == 0 )
                    	{
                    		
							swal(
							      'Oops...',
							      'Try Again later..',
							      'error'
							    )

                    	}
                    	else
                    	{
                    		
							swal(
							      'Success...',
							      'Request send successfully to this member',
							      'success'
							    );
							$("#send").html("sent");
							
                    	}

                        
                    }
                });	
			}
			return false;
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
