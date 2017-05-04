
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
									@foreach($result as $values)
									
										<div class="left-img pull-left">

											<!-- <img src="{{Request::root()}}/assets/frontend/img/profile-pic-boy.jpg" alt="" /> -->
											<img src="{{Request::root()}}/images/{{$values->image}}" height="197px" width="193" alt="image" />
										</div>
										
										
										<div class="right-content pull-right" id="{{ $values->id }}">

							
										<!-- checking currently online -->
										    @foreach($online as $current_online)
											    @if($values->id == $current_online->id)
												<div class="green-btn"><i aria-hidden="true" class="fa fa-circle"></i> currently Online</div>
												@endif
											@endforeach
										<!-- ends checking currently online -->	
											<input type="hidden" id="viewer" value="{{ $values->id }}">
											<h5>{{ $values->name }}</h5>
											@foreach($views as $view)
												@if($view->viewer_users_id == $values->id)
												<?php  
													
													$viewed_on = $view->created_at;
											        $today = date("Y-m-d h:i:s");
											        $diff = date_diff(date_create($viewed_on), date_create($today));
											        $y = $diff->format('%y');
											        $m = $diff->format('%m');
											        $d = $diff->format('%d'); 
											        $h = $diff->format('%h');
											        $i = $diff->format('%i');
											        $s = $diff->format('%s');
												 ?>

												<p>Viewed you: 
													@if(isset($y) && $y > 0) {{ $y." year ago"}}
													@elseif(isset($m) && $m > 0) {{ $m." month ago"}}
													@elseif(isset($d) && $d > 0) {{ $d." day ago"}}
													@elseif(isset($h) && $h > 0) {{ $h." hour ago"}}
													@elseif(isset($i) && $i > 0) {{ $i." minute ago"}}
													@else{{$i." second ago"}}
													@endif
												</p>
												@endif
											@endforeach
											<a href="{{url('/profile-about?id='.$values->id.'&page=online-now')}}" class="grey-btn" id="view">View Profile</a>
											<a data-toggle="modal" data-target="#myModal" class="report">Delete - Report/Block</a>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</li>
						</ul>
						<div id="myModal" class="modal fade" role="dialog">
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

//block or report about user
		$("#report").click(function(){
			var reason = $("#interested").val();
			var info = $("#additional").val();
			var user_id = $('#hidden_id').val();
			var true_users = "{{ Session::get('id') }}";
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