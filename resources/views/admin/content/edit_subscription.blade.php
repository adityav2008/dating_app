@extends('admin/layout/layout')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{Request::root()}}/admin/dashboard" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a>
      <a href="{{Request::root()}}/admin/manage-menu/resource-menu" class="current">Resources Menu's</a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        @if (session('success'))
        <div class="alert alert-success">
          <button class="close" data-dismiss="alert">×</button>
          {{ session('success') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-error">
          <button class="close" data-dismiss="alert">×</button>
          {{ session('error') }}
        </div>
        @endif
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Content </h5>
          </div>

          

          <div class="widget-content nopadding">
            <form action="{{Request::root()}}/admin/subscription/add-new-subscription" method="post" class="form-horizontal" enctype="multipart/form-data" name="subscription_validate" id="subscription_validate" novalidate="novalidate">
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
              <input type="hidden" name="action" value="{{$action}}" />
              <input type="hidden" name="id" value="@if($action=='update') {{$list->id}} @endif">
                <div class="control-group">
                  <label class="control-label">Name</label>
                  <div class="controls">
                    <input type="text" name="name" id="name" value="@if($action=='update') {{$list->name}} @endif">
                    @if ($errors->has('name'))
                        <span for="name" generated="true" class="help-inline">
                          {{ $errors->first('name') }}
                        </span>
                    @endif                    
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Time</label>
                  <div class="controls">
                    <input type="text" data-date="{{date('d-m-Y')}}" data-date-format="dd-mm-yyyy" value="@if($action=='update') {{$list->time}} @endif" placeholder="{{date('d-m-Y')}}" class="datepicker" name="time" id="date">
                    @if ($errors->has('time'))
                        <span for="time" generated="true" class="help-inline">
                          {{ $errors->first('time') }}
                        </span>
                    @endif                    
                  </div>
                </div>

                <div class="control-group @if ($errors->has('amount')) error @endif">
                  <label class="control-label">Amount</label>
                  <div class="controls">
                    <input type="text" name="amount" id="amount" value="@if($action=='update') {{$list->amount}} @endif">
                    @if ($errors->has('amount'))
                        <span for="amount" generated="true" class="help-inline">
                          {{ $errors->first('amount') }}
                        </span>
                    @endif

                  </div>
                </div>

                
                <div class="control-group">
                  <label class="control-label">Status</label>
                  <div class="controls">
                    <select name="status" required>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Save" class="btn btn-success">
                  <input type="reset" value="Reset" class="btn btn-default">
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{Request::root()}}/assets/admin/js/jquery.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.ui.custom.js"></script>
<script src="{{Request::root()}}/assets/admin/js/bootstrap.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/bootstrap-datepicker.js"></script>
<script src="{{Request::root()}}/assets/admin/js/bootstrap-colorpicker.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.uniform.js"></script>
<script src="{{Request::root()}}/assets/admin/js/select2.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.validate.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.form_common.js"></script>
<script src="{{Request::root()}}/assets/admin/js/wysihtml5-0.3.0.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.peity.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.form_validation.js"></script>
@stop
