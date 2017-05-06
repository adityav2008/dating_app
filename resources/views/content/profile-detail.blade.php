
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
				
			    function cm2feet($cm)
				{
				     $inches = $cm/2.54;
				     $feet = intval($inches/12);
				     $inches = $inches%12;
				     return sprintf('%d ft %d inch', $feet, $inches);
				}

			   
			
			    if(isset($search) || empty($search))
				{
					foreach ($search as $value) 
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

					if(!empty($search))
					{
				 
				    	$result = DB::table('manage_users')
					            ->whereNotIn('id',array(Session::get('id')))
					            ->where('gender',$res_for)
					            ->whereBetween('age', array( $res_fromAge, $res_toAge))
					            ->whereBetween('height', array( $res_fromHeight, $res_toHeight))
					            ->where('relationship',$res_relationship)
					            ->where('children',$res_children)
					            ->where('education',$res_education)
					            ->where('ethnicity',$res_ethnicity)
					            ->where('religion',$res_religion)
					            ->where('body_type',$res_bodyType)
					            ->where('smoking',$res_smoke)
					            ->paginate(28);   

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
					    
						 @if(count($added) != 0)
							<a href="#" class="grey-btn add" id="add" style="background: green;color: whitesmoke;">
								 Added
							</a>
						 @else
							<a href="#" class="grey-btn add">
								<i class="fa fa-plus-circle" id="add" aria-hidden="true"></i>
								 Add
							</a>
						 @endif

						 @if(count($winked) != 0)
							<a href="#" class="grey-btn wink" id="wink" style="background: orange;color: whitesmoke;">
								 Winked
							</a>
						 @else
							<a href="#" class="grey-btn wink" id="wink">
								 Wink
							</a>
						@endif
							
							<a class="btn2" data-toggle="modal" data-target="#myGift" ><i class="fa fa-gift" aria-hidden="true"></i> Send Gift</a>
						</div>
						<textarea placeholder="Send her a message..." id="msg"></textarea>

						<a href="#" class="btn2" id="send">
								 Send
							</a>
						<a id="advance" data-toggle="collapse" data-target="#demo" class="btn2">See Full Profile <i class="fa fa-caret-down" aria-hidden="true"></i></a>
					</div>
					<div class="clearfix"></div>
				</div>

				<!-- Trigger the modal with a button -->
				

				<!-- Modal -->
				<div id="myGift" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="text-align: center"><strong class="gifts-popup-v2__title">Make her smile with a gift!</strong></h4>
				      </div>
				      <div class="modal-body">
				        <ul class="gift-holder gifts-list">
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container">
				            	<img id="gift1" class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_125_128x128.png" alt="koala-heart-eyes">
				            </div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2">
				             <b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_124_128x128.png" alt="koala-gift-surprise"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_123_128x128.png" alt="koala-bikes"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_122_128x128.png" alt="koala-dinner"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_121_128x128.png" alt="koala-beer" ></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_120_128x128.png" alt="koala-coffee"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_119_128x128.png" alt="koala-flowers"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_100_128x128.png" alt="Teddy Bear"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>25 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_99_128x128.png" alt="Box of Chocolates"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>15 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_98_128x128.png" alt="Wine for Two"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>20 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_96_128x128.png" alt="Smooch"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>30 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_95_128x128.png" alt="Diamond Ring"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>100 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_94_128x128.png" alt="Candy Hearts"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_91_128x128.png" alt="Diamond Necklace"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>80 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_17_128x128.png" alt="Red Rose"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_16_128x128.png" alt="Bouquet"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>30 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_43_128x128.png" alt="Strawberry"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_42_128x128.png" alt="Mystery Gift Box"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>20 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_44_128x128.png" alt="Adoring Letter"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_19_128x128.png" alt="Bear with Heart"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>10 coins</div>
				         </li>
				         <li class="gifts-list__gift-wrapper">
				            <div class="gift-v2-container--gifts-list gift-v2-container"><img class="gift-v2-img" src="https://zephyrzoosk-a.akamaihd.net/zephyr-browser124/images/gifts/gift_20_128x128.png" alt="Cocktail"></div>
				            <div class="gifts-v2-cost" data-zat="profile-gift-popup-price--gifts-v2"><b></b>20 coins</div>
				         </li>
				      </ul>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
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
				<?php
				}
				?>

				<div class="paginate">
					{{ $result->appends(['id' => $result[0]->id ])->links() }}
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
		$("#add").click(function(){
			var user_ids = $('#hidden_id').val();
			var main_users = "{{ Session::get('id') }}";
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
			var main_users = "{{ Session::get('id') }}";
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
			var send_by = "{{Session::get('id')}}";
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