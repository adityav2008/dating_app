@extends('layout/layout')

@include('common/header_inner')

@section('content')

<section class="book-flights">
	<div class="container clearfix">

    <form method="post" action="{{Request::root()}}/payment-details">
      {{csrf_field()}}
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="details">
					<div class="payment">
						<h2>Payment</h2>
						<p>We use secure transmission</p>
						<ul class="card">
							<li><img src="{{Request::root()}}/images/paypal-icon1.png" alt="" /></li>
							<li><img src="{{Request::root()}}/images/paypal-icon2.png" alt="" /></li>
							<li><img src="{{Request::root()}}/images/paypal-icon3.png" alt="" /></li>
							<li><img src="{{Request::root()}}/images/paypal-icon4.png" alt="" /></li>
						</ul>
						<div class="pay-form">
							<div class="form-group">
								<label for="first-name*">Cardholder Name*</label>
								<input type="text" class="form-control" id="first-name" name="first-name" value="{{old('first-name')}}">
                @if ($errors->has('first-name')) <p class="help-block">{{ $errors->first('first-name') }}</p> @endif
							</div>
							<div class="form-inline clearfix">
								<div class="row">
									<div class="form-group col-xs-8">
										<label for="card_no*">Debit/Credit card number*</label>
										 <input type="tel" class="form-control" id="card_no" name="card_no" value="{{old('card_no')}}">
                     @if ($errors->has('card_no')) <p class="help-block">{{ $errors->first('card_no') }}</p> @endif
									</div>
									<div class="form-group col-xs-4">
										<label for="sel1">Passport country*</label>
										<select class="form-control" id="card_type" name="card_type">

											<option value="visa">Visa</option>
											<option value="mastercard">mastercard</option>
										</select>
                    @if ($errors->has('card_type')) <p class="help-block">{{ $errors->first('card_type') }}</p> @endif
									</div>
								</div>
							</div>
							<div class="form-inline clearfix">
								<div class="row">
									<div class="form-group col-xs-4">
										<label for="sel1">Expiration date*</label>
										<select class="form-control" id="expiry_date" name="expiry_date">
											<option selected>Month</option>
											<option>Month 1</option>
										</select>
                    @if ($errors->has('expiry_date')) <p class="help-block">{{ $errors->first('expiry_date') }}</p> @endif
									</div>
									<div class="form-group col-xs-3">
										<label for="sel1">&nbsp;</label>
										<select class="form-control" id="expiry_year" name="expiry_year">
											<option selected>Year</option>
											<option>Year 1</option>
										</select>
                    @if ($errors->has('expiry_year')) <p class="help-block">{{ $errors->first('expiry_year') }}</p> @endif
									</div>
									<div class="form-group col-xs-5">
										<label for="first-name*">CVV Number*</label>
										 <input type="text" class="form-control" id="security_code" name="security_code" value="{{old('security_code')}}">
                     @if ($errors->has('security_code')) <p class="help-block">{{ $errors->first('security_code') }}</p> @endif
									</div>
								</div>
							</div>
							<h5>OR</h5>
							<a href="#"><img src="images/paypal.jpg" alt="" /></a>
						</div>
					</div>
				</div><!--details close-->
			</div><!--col close-->
		</div><!--row close-->

<input type="submit" class="btn2" name="submit" value="Submit" />
</form>

	</div><!--container close-->
</section>

@endsection


<!--begin- script -->
<script src="js/jQuery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.inner-banner .banner-heading h2').each(function(){
	  var h = jQuery(this).html();
	  var index = h.indexOf(' ');
	  if(index == -1) {
	      index = h.length;
	  }
	  $(this).html('<span style="color:#d29c22;">' + h.substring(0, index) + '</span>' + h.substring(index, h.length));
      });
});
</script>
<!-- end-script -->

<!-- begin-style -->
<style>
::-webkit-input-placeholder{font-family: Arial, Helvetica, sans-serif; font-weight: 400; color: #767676; font-size:14px; opacity:1;}
::-moz-placeholder {font-family: Arial, Helvetica, sans-serif; font-weight: 400; color: #767676; font-size:14px; opacity:1;}
:-ms-input-placeholder{font-family: Arial, Helvetica, sans-serif; font-weight: 400; color: #767676; font-size:14px; opacity:1;}
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
a, a:hover {text-decoration: none;}
.align-center {text-align: center;}
.align-right {text-align: right;}
.pad-left0 {padding-left: 0;}
.pad-right0 {padding-right: 0;}
.mr0 {margin-bottom: 0;}
.mr20 {margin-bottom: 20px;}
.btn2{display:inline-block; font-family: Arial, Helvetica, sans-serif; font-size:18px; line-height:18px; color:#FFFFFF; font-weight:700; text-align:center; text-transform:uppercase; padding:10px 20px; margin:0; border:0; outline:none; background-color: #f5b503; border-radius: 3px;}
.btn2:hover{color:#FFFFFF; background-color: #1d1d1d;}
/*start*/
.book-flights {width: 100%; padding: 40px 0; }
.book-flights h2 {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#d29c22; font-size: 30px; text-transform: uppercase; margin: 0 0 15px 0;}
.book-flights .details {width: 100%;}
.book-flights .details h3.heading3 {background-color: #f5f5f5; background-image: url(../img/heading-arrow.png); background-repeat: no-repeat; background-position: 44% center; font-family: Arial, Helvetica, sans-serif; color:#1d1d1d; font-size: 30px; border-left: solid 10px #d0d2cf; padding: 18px 0 18px 15px; margin: 0 0 10px 0;}
.book-flights .details input.btn {}
.book-flights .details .travelling {background-color: #f5f5f5; padding: 25px; margin-bottom: 20px;}
.book-flights .details .travelling h3 {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#1d1d1d; font-size: 30px; margin: 0 0 10px 0; padding: 0;}
.book-flights .details .travelling p {font-family: Arial, Helvetica, sans-serif; color:#585858; font-size: 16px; margin-bottom: 30px;}
.book-flights .details .travelling h5 {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#1d1d1d; font-size: 18px; margin-bottom: 20px; display: inline-block; margin-top:0;}
.book-flights .details .travelling a.pull-right {background-image: url(../img/free-net.png); background-repeat: no-repeat; background-position: left center; color:#066d10; font-size: 18px; padding-left: 30px;}
.book-flights .details .travelling .form-inline {margin-bottom: 20px;}
.book-flights .details .travelling .form-inline .form-group {margin-right: 20px;}
.book-flights .details .travelling .form-inline .form-group:last-child {margin-right: 0;}
.book-flights .details .travelling .form-inline .form-group:last-child .form-control {width: 100%;}
.book-flights .details .travelling .form-inline .form-group label, .book-flights .details .travelling .from2 .form-group label, .book-flights .details .travelling .from2 .form-inline label.single, .book-flights .details .payment .pay-form .form-group label, .book-flights .details .confir-mail .form-group label, .car-detail .drivers-details .form-group label {font-family: Arial, Helvetica, sans-serif; font-weight: 400; font-size: 18px; color:#1d1d1d; display: block; margin-bottom: 5px;}
.book-flights .details .travelling .form-inline .form-group .form-control, .book-flights .details .travelling .from2 .form-group .form-control, .book-flights .details .payment .pay-form .form-group .form-control, .book-flights .details .confir-mail .form-group input, .car-detail .drivers-details .form-group input, .car-detail .drivers-details .form-group select {height: 40px; box-shadow: none; -moz-box-shadow: none; -webkit-box-shadow: none; border-color: #b0b0b0; font-size: 16px; width: 100%;}
.book-flights .details .travelling .from2 .form-group .form-control.text-area {height: auto;}
.book-flights .details .travelling .from2 .form-group select {background-color: #e4e4e4; background-image: url(../img/select-arrow.png); background-repeat: no-repeat; background-position: 98% center; appearance: none; -moz-appearance: none; -webkit-appearance: none; font-weight: 700;}
.book-flights .details .travelling .from2 .form-group label.radio-inline {display: inline-block; font-size: 14px; color:#7b7b7b;}
.book-flights .details .travelling .from2 .form-inline .form-group select {padding-right: 25px; background-position: 92% center;}
.book-flights .details .travelling a.more {background-image: url(../img/link-arrow.png); background-repeat:no-repeat; background-position: 39% 9px; font-family: Arial, Helvetica, sans-serif; font-weight: 700; font-size: 16px; color:#437dbd; display: block; border-bottom:solid 1px #9b9b9b; padding-bottom: 25px; margin-bottom: 30px;}
.book-flights .details .travelling a.more:hover {color:#1a1a1a; text-decoration: none;}
.book-flights .details .payment {padding: 25px; width: 100%; border: solid 1px #e2e2e2;}
.book-flights .details .payment h2 {font-family: Arial, Helvetica, sans-serif; font-weight: 400; color:#1d1d1d; font-size: 26px; text-transform: none; border-bottom: solid 1px #e2e2e2; padding-bottom: 15px;}
.book-flights .details .payment h5 {font-family: Arial, Helvetica, sans-serif; font-weight: 400; color:#1d1d1d; font-size: 18px; margin-bottom: 10px;}
.book-flights .details .payment a img {display: block;}
.book-flights .details .payment p {background-image: url(../img/green-right.png); background-repeat: no-repeat; background-position:left center; font-family: Arial, Helvetica, sans-serif; color:#136715; font-size: 16px; margin-bottom: 20px; padding-left: 20px;}
.book-flights .details .payment ul.card {margin: 0 0 20px 0; padding: 0;}
.book-flights .details .payment ul.card li {list-style: none; display: inline-block; margin-right: 10px;}
.book-flights .details .payment ul.card li:last-child {margin-right: 0;}
.book-flights .details .payment .pay-form {background-color: #f5f5f5; border: solid 1px #e2e2e2; padding:20px;}
.book-flights .details .payment .pay-form .form-inline {margin-bottom: 15px;}
.book-flights .details .payment .pay-form .form-group select {background-color: #e4e4e4; background-image: url(../img/select-arrow.png); background-repeat: no-repeat; background-position: 94% center; appearance: none; -moz-appearance: none; -webkit-appearance: none; font-weight: 700;}
.book-flights .details .billing {border-top: none 0; margin-bottom: 20px;}
.book-flights .details .billing h2 {border-bottom: none 0; margin-bottom: 0;}
.book-flights .details .billing .pay-form .form-group select {background-position: 98% center;}
.book-flights .details .whould {background-color: #f5f5f5; padding: 25px;}
.book-flights .details .whould h3 {background-image: url(../img/whould-icon.png); background-repeat: no-repeat; background-position: left center; padding:0 0 0 50px; margin: 0; font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#1d1d1d; font-size:30px; line-height: 1.2; margin-bottom: 15px;}
.book-flights .details .whould p {background-image: url(../img/yellow-right-icon.png); background-repeat: no-repeat; background-position: left center; font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#1d1d1d; font-size:16px; padding: 0 0 0 25px; margin-left: 52px; margin-bottom: 15px;}
.book-flights .details .whould ul {margin: 0 0 20px 52px; padding: 0 0 0 5px;;}
.book-flights .details .whould ul li {background-image: url(../img/ellipse-icon.png); background-repeat: no-repeat; background-position: left 7px; font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#686868; font-size:16px; list-style: none; margin: 0 0 10px 0; padding: 0 0 0 25px;}
.book-flights .details .whould a {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#437dbd; font-size:14px; margin-left: 72px;}
.book-flights .details .whould a:hover {color: #1a1a1a; text-decoration: none;}
.book-flights .details .you-need {width: 100%; padding: 25px;}
.book-flights .details .you-need p {font-family: Arial, Helvetica, sans-serif; font-weight: 400; color:#686868; font-size:16px;}
.book-flights .details .you-need p a {color:#437dbd; font-style: italic;}
.book-flights .details .you-need p a:hover {color:#000; text-decoration:none;}
.book-flights .trip-sum {}
.book-flights .trip-sum h2 {text-transform: none; color: #4d89c8; line-height: 30px;}
.book-flights .trip-sum .london {}
.book-flights .trip-sum .london h4 {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#474747; font-size:18px; margin-bottom: 10px;}
.book-flights .trip-sum .london p {font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #474747;}
.book-flights .trip-sum .london pre {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#474747; font-size:18px; background-color: transparent; border: none 0; padding: 0; margin: 0;}
.book-flights .trip-sum .london h5 {font-family: Arial, Helvetica, sans-serif; font-weight: 700; color:#a6273f; font-size:18px;}
.book-flights .trip-sum .london ul.aeroflot {margin: 0 0 25px 0; padding: 0; border:none 0;}
.book-flights .trip-sum .london ul.aeroflot li {font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #474747; list-style: none; display: inline-block; margin-right: 15px;}
.book-flights .trip-sum .london ul.aeroflot li:last-child {margin-right: 0;}
.book-flights .trip-sum .travel {width: 100%; margin-bottom: 10px;}
.book-flights .trip-sum .travel:nth-child(5) {padding-bottom: 20px; border-bottom: solid 1px #9b9b9b;}
.book-flights .trip-sum .travel .pull-left p {background-image: url(../img/yellow-down-arrow.png); background-repeat: no-repeat; background-position: right center; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #437dbd; font-weight: 700; margin: 0; padding-right: 20px;}
.book-flights .trip-sum .travel .pull-right p {font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #d29c22; margin: 0;}
.book-flights .trip-sum p.total {font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #d29c22; text-align: right;}
.book-flights .trip-sum p.total span {font-size: 20px; font-weight: 700;}
.book-flights .trip-sum p.ticket4 {color: #474747; font-size: 14px;}
.book-flights .trip-sum .only {background-color: #d6abb0; color: #a6273f; padding: 10px 20px; font-size: 14px; text-align: right; margin-bottom: 25px;}
.book-flights .trip-sum .promo-code {width: 100%;margin-bottom: 30px;}
.book-flights .trip-sum .promo-code h4 {font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #464646; font-weight: 400;}
.book-flights .trip-sum .promo-code .code {border: solid 1px #b0b0b0; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;}
.book-flights .trip-sum .promo-code .code input[type="text"] {border: 0; padding: 10px; -webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px; width: 203px;}
.book-flights .trip-sum .promo-code .code input.btn2 {font-weight: 400; height: 45px; -webkit-border-top-left-radius: 0px; -webkit-border-bottom-left-radius: 0px; -moz-border-radius-topleft: 0px; -moz-border-radius-bottomleft: 0px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; border-left: solid 1px #959595; width: 151px;}
.book-flights .trip-sum .oprator {width: 100%;}
.book-flights .trip-sum .oprator h3 {font-family: Arial, Helvetica, sans-serif; font-weight: 400; color:#5b5b5b; font-size: 24px; text-transform: none; border-bottom: solid 1px #e2e2e2; padding-bottom: 12px; margin-bottom: 15px;}
.book-flights .trip-sum ul.aeroflot {margin: 0 0 0;padding: 0; border-bottom: solid 1px #afafaf; padding-bottom: 5px;}
.book-flights .trip-sum ul.aeroflot li {color: #00519b; display: inline-block; font-family: Arial,Helvetica,sans-serif; font-size: 16px; list-style: outside none none; margin-right: 15px;}
.book-flights .trip-sum ul.agent {margin: 0;padding: 0; padding-bottom: 5px;}
.book-flights .trip-sum ul.agent li {list-style: outside none none;border-bottom: 1px solid #afafaf; padding: 10px 0;}
.book-flights .trip-sum ul.agent li ul {margin: 0; padding: 0;}
.book-flights .trip-sum ul.agent li ul li {font-family: Arial,Helvetica,sans-serif; font-size: 16px; color: #1b5b96; display: inline-block; border: none 0; padding: 0; width: 90px; vertical-align: top;}
.book-flights .trip-sum ul.agent li ul li:nth-child(2n){color:#4a4a4a; width: 265px;}

</style>
<!-- end-style -->
