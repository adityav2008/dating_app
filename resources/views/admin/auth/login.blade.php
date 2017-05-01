@extends('admin/layout/auth_layout')
@section('auth')

<div id="loginbox">
  <form class="form-vertical" role="form" method="POST" action="{{ url('/admin/login') }}">
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
                  {{ $errors->first('email') }}
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
                {{ $errors->first('password') }}
              </span>
          @endif
        </div>
      </div>
    </div>
    <div class="form-actions">
      <span class="pull-left"><a href="{{Request::root()}}/admin/password/reset" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
      <span class="pull-right"><button type="submit" class="btn btn-success login" >Login</button></span>
    </div>
  </form>
</div>

@stop
