@extends('admin/layout/auth_layout')
@section('auth')

<div id="loginbox">
  <form method="post" action="{{ url('admin/password/email') }}" class="form-vertical">
    {{ csrf_field() }}
    <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
    <div class="controls">
      <div class="main_input_box">
        <span class="add-on bg_lo">
          <i class="icon-envelope"></i>
        </span>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="help-block">
                {{ $errors->first('email') }}
            </span>
        @endif
      </div>
    </div>
    <div class="form-actions">
      <span class="pull-left"><a href="{{Request::root()}}/admin/login" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
      <span class="pull-right"><button type="submit" class="btn btn-info recover">Reecover</button></span>
    </div>
  </form>
</div>

@stop
