@extends('layout/layout')

@include('common/header_inner')

@section('content')

<div class="multi-step">
	<div class="container clearfix">
		@if (isset($errors) && $errors->has(''))
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>        
            @endforeach
        </div>
        @endif

		<form id="msform" method="POST" enctype="multipart/form-data" action="{{url('/new-account?id=')}}{{ $_GET['id'] }}">
		 {{csrf_field()}}
		 <input type="hidden" name="id" value="{{ $_GET['id'] }}">
			<!-- progressbar -->
			<ul id="progressbar">
				<li class="active">Get Started</li>
				<li>Your Photo</li>
				<li>About You</li>
			</ul>
			<!-- fieldsets -->
			<fieldset>
				<h2 class="fs-title">Get Started</h2>
				<div class="feild @if ($errors->has('name')) has-error @endif">
					<label>Display Name</label>
					<input type="text" name="name" placeholder="Daisy" />
					@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
				</div>
				<div class="feild  @if ($errors->has('location')) has-error @endif">
					<label>City or Zip Code</label>
					<input type="text" name="location" placeholder="201307 - Sec-55 Noida" />
					@if ($errors->has('location')) <p class="help-block">{{ $errors->first('location') }}</p> @endif
				</div>
				<input type="button" name="next" class="next action-button" value="Next" />
			</fieldset>
			<fieldset>
				<h2 class="fs-title">Your Photo</h2>
				<p>This is how people see you on datin so....</p>
				<ul class="your-photo">
					<li>- Use a clear photo</li>
					<li>- Be alone in your photo</li>
					<li>- Be in a well-it place</li>
				</ul>
				<div class="feild @if ($errors->has('image')) has-error @endif">
					<label class="btn btn-default btn-file">Upload a Photo <input type="file" style="display: none;" name="image" ></label>
					@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
				</div>
				<p class="note">Note: Your primary photo may be cropped for consistency. Photos that include nudity will not be approved.</p>
				<input name="previous" class="previous action-button" value="Previous" type="button">
				<input type="button" name="next" class="next action-button" value="Next" />
			</fieldset>
			<fieldset>
				<h2 class="fs-title">About You</h2>
				<div class="feild @if ($errors->has('body_type')) has-error @endif">
					<label>What’s your body type?</label>
					<select name="body_type">
						<option value="1">Slim</option>
						<option value="2">Athletic</option>
						<option value="3">Average</option>
						<option value="4">Curvy</option>
						<option value="5" selected="selected">Any</option>
					</select>
					@if ($errors->has('body_type')) <p class="help-block">{{ $errors->first('body_type') }}</p> @endif
				</div>
				<div class="feild @if ($errors->has('children')) has-error @endif">
					<label>Do you have children?</label>
					<select name="children">
						<option value="1">No</option>
						<option value="2">Yes, at home with me</option>
						<option value="3">Yes, but they don't live with me</option>
						<option value="any">Any</option>
					</select>
					@if ($errors->has('children')) <p class="help-block">{{ $errors->first('children') }}</p> @endif
				</div>
				<div class="feild @if ($errors->has('education')) has-error @endif">
					<label>What’s your highest level of education?</label>
					<select name="education">
						<option value="1">No degree</option>
						<option value="2">High school graduate</option>
						<option value="3">Attended college</option>
						<option value="4">College graduate</option>
						<option value="5">Advanced degree</option>
						<option value="any" selected="selected">Any</option>
					</select>
					@if ($errors->has('education')) <p class="help-block">{{ $errors->first('education') }}</p> @endif
				</div>
				<div class="feild @if ($errors->has('ethnicity')) has-error @endif">
					<label>What’s your ethnicity?</label>
					<select name="ethnicity">
						<option selected="7">White/Cucuasian</option>
						<option value="1">Asian</option>
						<option value="2">Black/African</option>
						<option value="3">Latino/Hispanic</option>
						<option value="9">Indian</option>
						<option value="4">Middle Eastern</option>
						<option value="8">Mixed/Other</option>
						<option value="any" selected="selected">Any</option>
					</select>
					@if ($errors->has('ethnicity')) <p class="help-block">{{ $errors->first('ethnicity') }}</p> @endif
				</div>
				<div class="feild @if ($errors->has('height')) has-error @endif">
					<label>What’s your height?</label>
					<div class="cm">
						<select class="js-criteria-height-min" name="height">
                           <option selected="selected" value="0"> -- </option>
                           @for ($i = 91; $i <= 241 ; $i++)
                           <option value="{{ $i }}"> {{ $i }} </option>
                           @endfor  
                        </select>
                        @if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
					</div>
					<span>cm</span>
				</div>
				<div class="feild @if ($errors->has('religion')) has-error @endif">
					<label>What’s your religion?</label>
					<select class="js-criteria-height-min" name="religion">
                        <option value="1">Agnostic</option>
						<option value="2">Atheist</option>
						<option value="3">Buddhist</option>
						<option value="4">Christian</option>
						<option value="5">Christian - Catholic</option>
						<option value="6">Jewish</option>
						<option value="7">Hindu</option>
						<option value="8">Muslim</option>
						<option value="9">Spiritual</option>
						<option value="10">Other</option>
						<option value="any" selected="selected">Any</option>
                    </select>
                    @if ($errors->has('religion')) <p class="help-block">{{ $errors->first('religion') }}</p> @endif
				</div>
				<div class="feild @if ($errors->has('relationship')) has-error @endif">
					<label>What’s your relationship status?</label>
					<select class="js-criteria-height-min" name="relationship">
                        <option value="1">Never married</option>
						<option value="2">Separated</option>
						<option value="3">Divorced</option>
						<option value="4">Widowed</option>
						<option value="5">Tell you later</option>
						<option value="any" selected="selected">Any</option>
                    </select>
                    @if ($errors->has('relationship')) <p class="help-block">{{ $errors->first('relationship') }}</p> @endif
				</div>
				
				<div class="feild @if ($errors->has('smoking')) has-error @endif">
					<label>Do you smoke?</label>
					<select name="smoking">
						<option selected="selected" value="1">No</option>
						<option value="2">Yes, socially</option>
						<option value="3">Yes, regularly</option>
						<option value="any">Any</option>
					</select>
					@if ($errors->has('smoking')) <p class="help-block">{{ $errors->first('smoking') }}</p> @endif
				</div>
				<input type="button" class="previous action-button" value="Previous" />
				<input type="submit" class="submit action-button" value="Submit" />
			</fieldset>
		</form>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
});

function showLogin(){
	$('.recover').hide();
	$('.div_login').show();
	$('#myModal').modal('show');
}

$('#recover').click(function(){
	$('.recover').show();
	$('.div_login').hide();
})

$('#go-back').click(function(){
	$('.recover').hide();
	$('.div_login').show();
})

	$(function() {
	
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	
	$(".next").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+"%";
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
	
	$(".previous").click(function(){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();
		
		//de-activate current step on progressbar
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
		
		//show the previous fieldset
		previous_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in "now"
				//1. scale previous_fs from 80% to 100%
				scale = 0.8 + (1 - now) * 0.2;
				//2. take current_fs to the right(50%) - from 0%
				left = ((1-now) * 50)+"%";
				//3. increase opacity of previous_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'left': left});
				previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	});
	
	
	
	});
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

</script>
@stop