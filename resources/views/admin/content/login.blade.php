<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dating Admin</title><meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="{{Request::root()}}/assets/admin/css/matrix-login.css" />
  <link href="{{Request::root()}}/assets/admin/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
  <div id="loginbox">
    <form id="loginform" class="form-vertical" role="form" method="POST" action="{{ url('/admin/login') }}">
      {{ csrf_field() }}
      <div class="control-group normal_text"> <h3><img src="{{Request::root()}}/assets/admin/img/logo.png" alt="Logo" /></h3></div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on bg_lg">
              <i class="icon-user"></i>
            </span>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="main_input_box">
            <span class="add-on bg_ly">
              <i class="icon-lock"></i>
            </span>
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>
      </div>
      <div class="form-actions">
        <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
        <span class="pull-right"><button type="submit" class="btn btn-success login" >Login</button></span>
      </div>
    </form>
    <!-- <form id="recoverform" method="post" action="{{ url('/admin/password/reset') }}" class="form-vertical">
      {{ csrf_field() }}
      <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
      <div class="controls">
        <div class="main_input_box">
          <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
        </div>
      </div>

      <div class="form-actions">
        <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
        <span class="pull-right"><button type="submit" class="btn btn-info recover">Reecover</button></span>
      </div>
    </form> -->
  </div>

  <script src="{{Request::root()}}/assets/admin/js/jquery.min.js"></script>
  <script src="{{Request::root()}}/assets/admin/js/matrix.login.js"></script>

</body>

</html>
