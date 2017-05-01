
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

					<div class="details-pro">
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
								      	<textarea maxlength="500" rows="5" cols="25" name="additionalInfo" class="additional-info js-additional-info"></textarea>
								      </div>

								      <p style="padding: 10px 2px;">All reports are confidential. Once you report a member, she will be blocked from contacting you on Zoosk and won't show up in your Carousel or searches.</p>
							      </div>
						      <div class="modal-footer">
						      		 <button class="btn2" style="text-align: center" > Report and Block </button>
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>

						  </div>
						</div>
						<div class="three-btn">
							<a href="#" class="grey-btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</a>
							<a href="#" class="grey-btn">Wink</a>
							<a href="#" class="btn2"><i class="fa fa-gift" aria-hidden="true"></i> Send Gift</a>
						</div>
						<textarea placeholder="Send her a message..."></textarea>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="pro-basics">
					<div class="heart-heading">
						<h3>Basics</h3>
					</div>
					<div class="basics">
						<ul>
							<!-- <li class="clearfix">
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
							</li> -->
							
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
		</div>
	</div>
</section>
<script type="text/javascript">
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

<script src="https://www.gstatic.com/firebasejs/3.7.5/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCcGNaadNwjtjDrv2hcflKRnA8kUzpKxj8",
    authDomain: "casual-93aa5.firebaseapp.com",
    databaseURL: "https://casual-93aa5.firebaseio.com",
    projectId: "casual-93aa5",
    storageBucket: "casual-93aa5.appspot.com",
    messagingSenderId: "463511042041"
  };
  firebase.initializeApp(config);
</script>
@stop