@extends('layout/layout')
@include('common/header_inner')
@section('content')
<script src="http://malsup.github.com/jquery.form.js"></script>
<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/frontend/css/component.css" />

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
				<?php
				$values = DB::table('manage_users')->where('id','=',$_GET['id'])->first();
				function cm2feet($cm)
				{
					$inches = $cm/2.54;
					$feet = intval($inches/12);
					$inches = $inches%12;
					return sprintf('%d ft %d inch', $feet, $inches);
				}
				?>
				<div class="profile-main">
					<div class="profile-pic pull-left">
						<div class="pro-pic">
							<img src="{{url('/images')}}/{{ $values->image }}" alt="" height="250px" width="300px" />
						</div>
						<div class="tow-btn">
							<ul class="clearfix">
								<li class="pull-left">
									<a class="grey-btn" data-toggle="modal" data-target="#myModal" href="#myModal">Add Photo <i class="fa fa-photo" aria-hidden="true"></i></a>
								</li>
								<div id="myModal" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title" style="text-align: center">Add Photo</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<form id="add_image" action="{{url('/profile')}}" method="post" enctype="multipart/form-data">
														{{csrf_field()}}
														<input type="hidden" name="action" value="add_image">
														<input type="hidden" name="manage_users_id" value="{{Session::get('id')}}">
														<div class="box">
															<input type="file" name="image[]" id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple style="height:0px;visibility:hidden;"/>
															<label for="file-5">
																<figure>
																	<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
																		<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
																	</svg>
																</figure>
															<span>Choose a file&hellip;</span></label>
														</div>
													</form>
												</div>
												<div class="row">
													<p class="note-align" style="text-align:center;">(Choose a jpg, png, gif or bmp file.)</p>
													<p class="note-align">	Your primary photo must be a clear photo of you—and only you. Your face should be clearly visible in your primary photo. Photos containing copyrighted, pornographic or offensive material, underage individuals, or photos where you are not clearly identifiable will be removed </p>
												</div>
											</div>
											<div class="clearfix"></div>
											<div class="modal-footer" style="text-align: center">
												<p> Note: Your primary photo may be cropped for consistency.</p>
												<p> Photos that include nudity will not be approved.</p>
											</div>
										</div>
									</div>
								</div>
								<li class="pull-right">
									<a class="grey-btn" href="#">Edit Photos <i class="fa fa-edit" aria-hidden="true"></i></a>
								</li>
							</ul>
						</div>
						<div class="add-samll-pic">
							<img src="{{url('/images')}}/{{ $values->image }}" alt="" height="50px" width="50px" />
						</div>
					</div>
					<div class="profile-right pull-right">
						<div class="edit-big-btn">
							<p>{{ $values->name }}</p>
							<span>
								<div class="dropdown">
									<a class="btn" type="button" data-toggle="dropdown">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>
									<ul class="dropdown-menu">
										<li>
											<div class="form-group">
												<input type="text" id="user_name" class="form-control" placeholder="Jasmine lee" />
											</div>
										</li>
										<li>
											<button id="name" class="btn2">Save</button>
										</li>
									</ul>
								</div>
							</span>
						</div>
						<div class="edit-big-btn">
							<p>{{ $values->age }} Years Old</p>
							<span>
								<div class="dropdown">
									<a class="btn" type="button" data-toggle="dropdown">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>
									<ul class="dropdown-menu">
										<li>
											<div class="form-group">
												<input type="date" id="user_dob" class="form-control" placeholder="Jasmine lee" />
											</div>
										</li>
										<li>
											<button class="btn2" id="dob">Save</button>
										</li>
									</ul>
								</div>
							</span>
						</div>
						<div class="edit-big-btn">
							<p>{{$values->state}}, {{$values->country}}</p>
							<span>
								<div class="dropdown">
									<a class="btn" type="button" data-toggle="dropdown">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>
									<ul class="dropdown-menu">
										<li>
											<div class="form-group">
												<input type="text" class="form-control" id="user_location" placeholder="Jasmine lee" />
											</div>
										</li>
										<li>
											<button id="location" class="btn2">Save</button>
										</li>
									</ul>
								</div>
							</span>
						</div>
						<div class="members">
							<h4>Members receive an average of 3 times more views while they Boost.</h4>
							<div class="member-pic">
								<img src="{{Request::root()}}/assets/frontend/img/member-pics.png" alt="" />
								<div class="member-single-pic">
									<img src="{{url('/images')}}/{{ $values->image }}" height='101px' width="101px" alt="" />
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
							<span class="pull-left"><i class="fa fa-envelope" aria-hidden="true"></i>Email Id</span>
							<button class="btn2">Verify Now</button>
						</li>
						<li class="clearfix">
							<span class="pull-left"><i class="fa fa-facebook-square" aria-hidden="true"></i>Facebook Verified</span>
							<?php
							$facebook = DB::table('manage_users')
													->where('id',Session::get('id'))
													->get();
							?>
							@foreach($facebook as $fb)
								@if($fb->verified != 1)
									<button class="btn2">Verify Now</button>
								@else
									<button class="btn2 green-btn">Verified</button>
								@endif
							@endforeach
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
								<strong>Sign:</strong>
								<span>
									@if($values->astro_sign == 1)
									{{ "Aries" }}
									@elseif($values->astro_sign == 2)
									{{ "Taurus" }}
									@elseif($values->astro_sign == 3)
									{{ "Gemini" }}
									@elseif($values->astro_sign == 4)
									{{ "Cancer" }}
									@elseif($values->astro_sign == 5)
									{{ "Leo"}}
									@elseif($values->astro_sign == 6)
									{{ "Virgo" }}
									@elseif($values->astro_sign == 7)
									{{ "Libra"}}
									@elseif($values->astro_sign == 8)
									{{ "Scorpio"}}
									@elseif($values->astro_sign == 9)
									{{ "Sagittarius" }}
									@elseif($values->astro_sign == 10)
									{{ "Capricorn"}}
									@elseif($values->astro_sign == 11)
									{{ "Aquarius" }}
									@else
									{{ "Pisces" }}
									@endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Height:</strong> <span>{{ cm2feet($values->height) }} / {{ $values->height }} cm</span>
							</li>
							<li class="clearfix">
								<strong>Ethnicity:</strong>
								<span>
									@if($values->ethnicity == 1)
									{{ "Asian" }}
									@elseif($values->ethnicity == 2)
									{{ "Black/African" }}
									@elseif($values->ethnicity == 3)
									{{ "Latino/Hispanic" }}
									@elseif($values->ethnicity == 4)
									{{ "Middle Eastern" }}
									@elseif($values->ethnicity == 7)
									{{ "White/Caucasian"}}
									@elseif($values->ethnicity == 8)
									{{ "Mixed/Other" }}
									@elseif($values->ethnicity == 9)
									{{ "Indian"}}
									@else
									{{ "Any" }}
									@endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Body Type:</strong>
								<span>
									@if($values->body_type == 1)
									{{ "Slim" }}
									@elseif($values->body_type == 2)
									{{ "Athletic" }}
									@elseif($values->body_type == 3)
									{{ "Average" }}
									@elseif($values->body_type == 4)
									{{ "Curvy" }}
									@else
									{{ "Any" }}
									@endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Children:</strong>
								<span>
									@if($values->children == 1)
									{{ "No" }}
									@elseif($values->children == 2)
									{{ "Yes, at home with me"}}
									@elseif($values->children == 3)
									{{ "Yes, but they don't live with me"}}
									@else
									{{ "Any" }}
									@endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Education:</strong>
								<span>
									@if($values->education == 1)
									{{ "No degree" }}
									@elseif($values->education == 2)
									{{ "High school graduate" }}
									@elseif($values->education == 3)
									{{ "Attended college" }}
									@elseif($values->education == 4)
									{{ "College graduate" }}
									@elseif($values->education == 5)
									{{ "Advanced degree"}}
									@else
									{{ "Any" }}
									@endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Religion:</strong>
								<span>
									@if($values->religion == 1)
									{{ "Agnostic" }}
									@elseif($values->religion == 2)
									{{ "Atheist" }}
									@elseif($values->religion == 3)
									{{ "Buddhist" }}
									@elseif($values->religion == 4)
									{{ "Christian" }}
									@elseif($values->religion == 5)
									{{ "Christian - Catholic"}}
									@elseif($values->religion == 6)
									{{ "Jewish" }}
									@elseif($values->religion == 7)
									{{ "Hindu"}}
									@elseif($values->religion == 8)
									{{ "Muslim"}}
									@elseif($values->religion == 9)
									{{ "Spiritual" }}
									@elseif($values->religion == 10)
									{{ "Other"}}
									@else
									{{ "Any" }}
									@endif
								</span>
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
<script src="{{Request::root()}}/assets/frontend/js/custom-file-input.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: false
	});

	//update name
	$("#name").click(function(){
		var name = $("#user_name").val();
		var main_users = "{{ Session::get('id') }}";
		// Returns successful data submission message when the entered information is stored in database.
		if(name =='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type:'post',
				url:"profile",
				dataType:'json',
				data:{
					user_name: name,
					manage_users_id : main_users,
					action : 'update_name',
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
						$('#myModal').modal('hide');
						location.reload();
					}
					else
					{
						swal(
							'Success...',
							'Name updated !',
							'success'
						);
						$('.close').click();
						location.reload();
					}
				}
			});
		}
		return false;
	})

	//update age
	$("#dob").click(function(){
		var age = $("#user_dob").val();
		var main_users = "{{ Session::get('id') }}";
		// Returns successful data submission message when the entered information is stored in database.
		if(age =='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type:'post',
				url:"profile",
				dataType:'json',
				data:{
					dob : age,
					manage_users_id : main_users,
					action : 'update_dob',
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

						$('#myModal').modal('hide');
						location.reload();
					}
					else
					{
						swal(
							'Success...',
							'Age updated !',
							'success'
						);
						$('.close').click();
						location.reload();
					}
				}
			});
		}
		return false;
	})

	//update location
	$("#location").click(function(){
		var user_location = $("#user_location").val();
		var main_users = "{{ Session::get('id') }}";
		// Returns successful data submission message when the entered information is stored in database.

		if(user_location =='')
		{
			swal(
				'Oops...',
				'Please Enter Postal Code or Zip Code to Continue',
				'error'
			)
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type:'post',
				url:"profile",
				dataType:'json',
				data:{
					location : user_location,
					manage_users_id : main_users,
					action : 'update_location',
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

						$('#myModal').modal('hide');
						setTimeout(function(){
		          location.reload();
		        },2000)
					}
					else
					{

						swal(
							'Success...',
							'location updated !',
							'success'
						);
						$('.close').click();
						setTimeout(function(){
		          location.reload();
		        },2000)
					}


				}
			});
		}
		return false;
	})

	//update age
	$("#image").click(function(){
		var user_image = $("#user_image").val();
		var main_users = "{{ Session::get('id') }}";
		// Returns successful data submission message when the entered information is stored in database.

		if(image =='')
		{
			alert("Please Fill All Fields");
		}
		else
		{
			// AJAX Code To Submit Form.
			$.ajax({
				type:'post',
				url:"profile",
				dataType:'json',
				data:{
					image : user_image,
					manage_users_id : main_users,
					action : 'add_image',
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
						$('#myModal').modal('hide');
						location.reload();
					}
					else
					{
						swal(
							'Success...',
							'Image added !',
							'success'
						);
						$('.close').click();
						location.reload();
					}
				}
			});
		}
		return false;
	})
});

$(function(){
	// Find any date inputs and override their functionality
	$('input[type="date"]').datepicker({
		dateFormat : 'yy-mm-dd'
	});
});

$(document).on("change", "#file-5", function () {

  $('#add_image').ajaxSubmit({
    success: function (response) {
			if(response == 0 )
			{
				swal(
					'Oops...',
					'Images not Uploaded..',
					'error'
				)
				$('#myModal').modal('hide');
				$("#file-5").val('');
			}
			else
			{
				swal(
					'Success...',
					'Image Uploaded.',
					'success'
				);
				$('#myModal').modal('hide');
				$("#file-5").val('');
			}
    }
  });

});
</script>
@endsection
