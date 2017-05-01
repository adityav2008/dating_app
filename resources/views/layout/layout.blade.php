<!DOCTYPE html>

<html>

<head>

<title>Dating</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="format-detection" content="telephone=no" />

<link href="{{Request::root()}}/assets/frontend/css/bxslider.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/jquery-ui.css" type="text/css"	 />

<link href="{{Request::root()}}/assets/frontend/css/nav.css" rel="stylesheet" type="text/css" />

<link href="{{Request::root()}}/assets/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<link href="{{Request::root()}}/assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" />

<link href="{{Request::root()}}/assets/frontend/css/main.css" rel="stylesheet" type="text/css" />

<script src="{{Request::root()}}/assets/frontend/js/html5.js"></script>

<link href="{{Request::root()}}/assets/frontend/css/media.css" rel="stylesheet" type="text/css" />

<script src="{{Request::root()}}/assets/frontend/js/jQuery.js" type="text/javascript"></script>

<script src="{{Request::root()}}/assets/frontend/js/bxslider.js" type="text/javascript"></script>

<script src="{{Request::root()}}/assets/frontend/js/nav.js" type="text/javascript"></script>

<script src="{{Request::root()}}/assets/frontend/js/jquery-ui.js" type="text/javascript"></script>

<script src="{{Request::root()}}/assets/frontend/js/hubslider.js" type="text/javascript"></script>

<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/easing.min.js" type="text/javascript"></script>

<link href="https://cdn.jsdelivr.net/sweetalert2/6.5.6/sweetalert2.min.css" rel="stylesheet" type="text/css">

<script src="https://cdn.jsdelivr.net/sweetalert2/6.6.0/sweetalert2.min.js"></script>

</head>

<body>

  @yield('content')



  @include('common/footer')



<script type="text/javascript">



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

</script>

</body>

</html>

