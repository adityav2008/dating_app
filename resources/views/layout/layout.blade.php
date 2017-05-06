<!DOCTYPE html>

<html>
<head>
<title>{{env('APP_NAME')}}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">

<link href="{{Request::root()}}/assets/frontend/css/bxslider.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/jquery-ui.css" type="text/css"	 />
<link href="{{Request::root()}}/assets/frontend/css/nav.css" rel="stylesheet" type="text/css" />
<link href="{{Request::root()}}/assets/frontend/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="{{Request::root()}}/assets/frontend/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="{{Request::root()}}/assets/frontend/css/main.css" rel="stylesheet" type="text/css" />
<script src="{{Request::root()}}/assets/frontend/js/html5.js"></script>
<link href="{{Request::root()}}/assets/frontend/css/media.css" rel="stylesheet" type="text/css" />
<!-- Tile icon for Win8 -->
<meta name="msapplication-TileColor" content="#3372DF">
<meta name="msapplication-navbutton-color" content="#303F9F">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Friendly Chat">
<meta name="apple-mobile-web-app-status-bar-style" content="#303F9F">

<!-- Disable tap highlight on IE -->
<meta name="msapplication-tap-highlight" content="no">

<!-- Web Application Manifest -->
<link rel="manifest" href="manifest.json">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="Friendly Chat">
<meta name="theme-color" content="#303F9F">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-database.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js"></script>

<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>

<script src="{{Request::root()}}/assets/frontend/js/main.js" type="text/javascript" ></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAUqrwda5Ns1JWPw1JyXW3f6QOZG0yhnf8",
    authDomain: "casual-seduction-d9079.firebaseapp.com",
    databaseURL: "https://casual-seduction-d9079.firebaseio.com",
    projectId: "casual-seduction-d9079",
    storageBucket: "casual-seduction-d9079.appspot.com",
    messagingSenderId: "995545041252"
  };
  firebase.initializeApp(config);
  var database = firebase.database();
</script>

<script src="{{Request::root()}}/assets/frontend/js/jQuery.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/bxslider.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/nav.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/jquery-ui.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/hubslider.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{Request::root()}}/assets/frontend/js/easing.min.js" type="text/javascript"></script>
<link href="{{Request::root()}}/assets/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="{{Request::root()}}/assets/sweetalert2/sweetalert2.min.js"></script>
<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
<style>
	#google-language {position: fixed;bottom: 0;left: 0;display:inline-block;width:200px;}
	.goog-te-banner-frame.skiptranslate { display: none !important; }
	body{ top: 0px !important; }
</style>
<script type="text/javascript">
   function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
	  		    includedLanguages: 'ar,de,en,es,fr,it,nl',
            autoDisplay: true
        }, 'google_translate_element');
        var a = document.querySelector("#google_translate_element select");
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<body>
  <div id="google-language" class="col-sm-12">
      <div id="google_translate_element">
  		<div class="skiptranslate goog-te-gadget" style="">
  			<div id=":1.targetLanguage">

  			</div>
  		</div>
  	</div>
  </div>
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
