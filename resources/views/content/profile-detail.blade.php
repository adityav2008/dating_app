
@extends('layout/layout')

@include('common/header_inner')

@section('content')
<section class="main-content pro-search pro-details">
	<div class="container">
		<div class="row">
		<div class="col-lg-3">

           @include('common/sidebar')

		    </div>
			<div class="col-lg-9">
				<div class="heading-sec1">
					<div class="grid-view">
						<div class="grid-list pull-left">
							<a href="{{url('/profile-search?id=')}}{{ $_GET['id'] }}"><img src="{{Request::root()}}/assets/frontend/img/list-icon-black.png" alt="" /></a>
							<a href="{{url('/profile-detail?id=')}}{{ $_GET['id'] }}"><img src="{{Request::root()}}/assets/frontend/img/gird-view-blue.png" alt="" /></a>
						</div>
						<div class="go pull-right">
							<a href="#">
								<img src="{{Request::root()}}/assets/frontend/img/go-invisible.png" alt="" /> Go Invisible
							</a>
						</div>	
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="edit-search">
							<div class="loction-show pull-left">
								<ul class="clearfix">
									<li><span>Women</span> interested in <span>Men</span></li>
									<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
									<li>Ages <span>18</span> to <span>30</span></li>
									<li><i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
									<li>within <span>15</span> km of Delhi</li>
								</ul>
							</div>
							<a href="{{url('/search-edit?id=')}}{{ $_GET['id'] }}" class="search-a pull-right">Search Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						</div>
					</div>
				</div>
				<?php
				
			    $result = DB::table('manage_users')
			    				->whereNotIn('id',array($_GET['id']))
			    				->where('status',1)
			    				->paginate(1);
                 
			    function cm2feet($cm)
				{
				     $inches = $cm/2.54;
				     $feet = intval($inches/12);
				     $inches = $inches%12;
				     return sprintf('%d ft %d inch', $feet, $inches);
				}

			    ?>

			    

			    @foreach($result as $values)
			    
      			<div class="details-pro" id="{{ $values->id }}" >
					<div class="profile-pic pull-left">
						<div class="pro-pic">
							<img src="{{url('/images')}}/{{ $values->image }}" alt="">
						</div>
					</div>
					<div class="pro-right pull-right">
						<div class="pro-top">
							<ul class="clearfix">
								<li>
									<h5>{{ $values->age }}</h5>
									<p>Years Old</p>
								</li>
								<li>
									<h5>{{ $values->location }}</h5>
									<p>(less than one km away)</p>
								</li>
								<li>
									<h5>{{ $values->name }}</h5>
									<p>{{ cm2feet($values->height) }} /{{ $values->height }} cm </p>
								</li>
								<li>
									<div class="dropdown">
								    <p class="dropdown-toggle" type="button" data-toggle="dropdown"><a href="#"><img src="{{Request::root()}}/assets/frontend/img/down-arrow.png" alt="" /></a>
								    <ul class="dropdown-menu dropdown-menu-right">
								      <li><a data-toggle="modal" data-target="#myModal" >Report / Block</a></li>
								    </ul>
								  </div>
								</li>
							</ul>
						</div>
						<div id="myModal" class="modal fade" role="dialog" style="top:140;">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title" style="text-align: center">Why are you reporting this?</h4>
						      </div>
							      <div class="modal-body">
							      	<input type="hidden" id="hidden_id" name="id" value="{{ $values->id }}">
								      <select id="interested" name="reason" class="reason js-report-select">
									      <option selected="selected" value="0">Not Interested</option>
									      <option value="1">Under 18 Years Old</option>
									      <option value="2">Hate Speech</option>
									      <option value="3">Inappropriate Photo</option>
									      <option value="4">Harassment</option>
									      <option value="5">Spam</option>
									      <option value="6">Fake Member</option>
									      <option value="7">Inappropriate Content</option>
								      </select>

								      <div id="additional-info" style="display: none;padding-top: 15px">
								      	<label class="additional-info-label">Additional Information</label>
								      	<textarea maxlength="500" rows="5" cols="25" name="additionalInfo" id="additional" class="additional-info js-additional-info"></textarea>
								      </div>

								      <p style="padding: 10px 2px;">All reports are confidential. Once you report a member, she will be blocked from contacting you on Zoosk and won't show up in your Carousel or searches.</p>
							      </div>
						      <div class="modal-footer">
						      		<button class="btn2" id="report" style="text-align: center" >
						      		 	Report and Block 
						      		</button>
						        	<button type="button" class="btn btn-default" data-dismiss="modal">
						        		Close
						        	</button>
						      </div>
						    </div>

						  </div>
						</div>
						<div class="three-btn" id="{{ $values->id }}">
						<?php
						// get added, winked and gift sent to other profile
						$added = DB::table('user_connections')
			    				->where('manage_users_id',$_GET['id'])
			    				->get();
						 ?>
					     
						 @if($added[0]->added_user_id == $values->id )
							<a href="#" class="grey-btn add" style="background: green;color: whitesmoke;">
								 Addded
							</a>
						@else
							<a href="#" class="grey-btn add">
								<i class="fa fa-plus-circle" aria-hidden="true"></i>
								 Add
							</a>
						@endif

						@if($added[0]->wink_user_id == $values->id )
							<a href="#" class="grey-btn wink" id="wink" style="background: orange;color: whitesmoke;">
								 Winked
							</a>
						@else
							<a href="#" class="grey-btn wink" id="wink">
								 Wink
							</a>
						@endif
							
							<a href="#" class="btn2"><i class="fa fa-gift" aria-hidden="true"></i> Send Gift</a>
						</div>
						<textarea placeholder="Send her a message..." id="msg"></textarea>

						<a href="#" class="btn2" id="send">
								 Send
							</a>
						<a id="advance" data-toggle="collapse" data-target="#demo" class="btn2">See Full Profile <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					</div>
					<div class="clearfix"></div>
				</div>
				
		    <div class="collapse" id="demo"> 
				<div class="pro-basics">
					<div class="heart-heading">
						<h3>Basics</h3>
					</div>
					<div class="basics">
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

		                            @endif</span>
							</li>
							
							<li class="clearfix">
								<strong>Relationship History:</strong>
								<span>
								@if($values->relationship == 1)
		                            {{ "Never married" }}
		                            @elseif($values->relationship == 2)
		                            {{ "Separated"}}
		                            @elseif($values->relationship == 3)
		                             {{ "Divorced"}}
		                            @elseif($values->relationship == 4)
		                            {{ "Widowed" }} 
		                            @elseif($values->relationship == 5)
		                            {{ "Tell you later" }} 
		                            @else
		                            {{ "Any" }}  
		                            @endif
								</span>
							</li>
							<li class="clearfix">
								<strong>Height:</strong> <span>{{ cm2feet($values->height) }} /{{ $values->height }} cm </span>
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
								<strong>Sex:</strong> 
								<span>
								{{ $values->gender }}
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
						</ul>
					</div>
				</div>
				<div class="gifts">
					<div class="heart-heading">
						<h3>gifts</h3>
					</div>
					<img src="{{Request::root()}}/assets/frontend/img/gifts.png" alt="" />
				</div>
				<div class="verifi-main">
					<div class="heart-heading">
						<h3>Verification</h3>
					</div>
					<ul>
						<li class="clearfix">
							<span class="pull-left"><i class="fa fa-facebook-square" aria-hidden="true"></i>Facebook Verified</span>
							<div class="pull-right"><img src="{{Request::root()}}/assets/frontend/img/green-right-icon.png" alt="" /></div>
						</li>
					</ul>
				</div>
				</div>
				@endforeach
				<div class="paginate">
					{{ $result->appends(['id' => $_GET['id']])->links() }}
				</div>
				
				
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	//create new task / update existing task
	$(document).ready(function(){

		//block or report about user
		$("#report").click(function(){
			var reason = $("#interested").val();
			var info = $("#additional").val();
			var user_id = $('#hidden_id').val();
			var true_users = "{{ $_GET['id'] }}";

			// Returns successful data submission message when the entered information is stored in database.

			if(reason ==''|| info =='')
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"profile-detail",
                    dataType:'json',
                    data:{ 
                    		manage_users_id : user_id,
                    	  	reason_id:reason,
                    	  	report_by_user_id : true_users,
                    	  	additional_info:info,
                    	  	action : 'block',
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
                    	}
                    	else
                    	{
                    		
							swal(
							      'Success...',
							      'Profile Blocked ! You will never seen this profile again',
							      'success'
							    );
							$('.close').click();
                    	}

                        
                    }
                });	
			}
			return false;
		});

		// add user to connections 
		$(".grey-btn").click(function(){
			var user_ids = $('#hidden_id').val();
			var main_users = "{{ $_GET['id'] }}";
			// Returns successful data submission message when the entered information is stored in database.
			if(user_ids == '' || main_users == '')
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"profile-detail",
                    dataType:'json',
                    data:{ 

                    		added_user_id : user_ids,
                    		manage_users_id : main_users,
                    	  	action : 'add',
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
							      'Profile Added to your connections',
							      'success'
							    );
							$(".grey-btn add").html("Added");
							
                    	}

                        
                    }
                });	
			}
			return false;
		});

		// wink other users 
		$("#wink").click(function(){
			var user_ids = $('#hidden_id').val();
			var main_users = "{{ $_GET['id'] }}";
			// Returns successful data submission message when the entered information is stored in database.
			if(user_ids == '' || main_users == '')
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"profile-detail",
                    dataType:'json',
                    data:{ 

                    		wink_user_id : user_ids,
                    		manage_users_id : main_users,
                    	  	action : 'wink',
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
							      'You just wink to this member',
							      'success'
							    );
							$("#wink").html("winked");
							
                    	}

                        
                    }
                });	
			}
			return false;
		});

		// send messege to others
		$("#send").click(function(){
			var user_idss = $('#hidden_id').val();
			var send_by = "{{ $_GET['id'] }}";
			var msg = $('#msg').val();
			// Returns successful data submission message when the entered information is stored in database.
			if(user_idss == '' || send_by == '' || msg == '' )
			{
			  alert("Please Fill All Fields");
			}
			else
			{
			// AJAX Code To Submit Form.
				 $.ajax({
                    type:'post',
                    url:"profile-detail",
                    dataType:'json',
                    data:{ 
                    		messenger_id : send_by,
                    		manage_users_id : user_idss,
                    		message : msg,
                    	  	action : 'send',
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
							      'Message send successfully to this member',
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
	

</script>
<script type="text/javascript">
	 $(function () {
   	$("#advance").click(function (){
   		$("#advance").hide();
   	});
   });

   $("#interested").change(function (){

      var choice = jQuery(this).val();
      if($(this).val() == '0')
      {
          $("#additional-info").css('display','none');
      
      }
      else {

          $("#additional-info").css('display','block');
      } 
  });
</script>

@stop