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
            @if(isset($newsletter))
              <form action="{{Request::root()}}/admin/newsletter/add-new-newsletter" method="post" class="form-horizontal" enctype="multipart/form-data" name="basic_validate" id="basic_validate" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="action" value="edit"/>
                <input type="hidden" name="id" value="{{$newsletter->id}}" />
            @else
              <form action="{{Request::root()}}/admin/newsletter/add-new-newsletter" method="post" class="form-horizontal" enctype="multipart/form-data" name="basic_validate" id="basic_validate" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <input type="hidden" name="action" value="add" />
            @endif
                <div class="control-group @if ($errors->has('name')) error @endif">
                  <label class="control-label">Newsletter Name</label>
                  <div class="controls">
                    @if(isset($newsletter))
                    <input type="text" name="name" id="name" value="@if($errors->has('name')){{old('name')}}@else{{$newsletter->name}}@endif ">
                      @if ($errors->has('name'))
                          <span for="email" generated="true" class="help-inline">
                            {{ $errors->first('name') }}
                          </span>
                      @endif
                    @else
                    <input type="text" name="name" id="name" value="{{old('name')}}">
                    @endif
                  </div>
                </div>
                <div class="control-group @if ($errors->has('email')) error @endif">
                  <label class="control-label">Newsletter Message</label>
                  <div class="controls">
                    @if(isset($newsletter))
                      <textarea name="message" id="message">
                        @if($errors->has('message')){{old('message')}}@else{{$newsletter->message}}@endif
                         </textarea>  
                      @if ($errors->has('message'))
                          <span for="email" generated="true" class="help-inline">
                            {{ $errors->first('message') }}
                          </span>
                             @endif
                             @else
                           <textarea name="message" id="message">
                             {{old('message')}}
                              </textarea>
                             @if ($errors->has('message'))
                            <span for="email" generated="true" class="help-inline">
                             {{ $errors->first('message') }}
                    </span>
                    @endif
                    @endif
                 </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Status</label>
                  <div class="controls">
                  
                    <select name="status" name="myselect" required value="">
                      <option value="1" @if(isset($newsletter) && $newsletter->status == 1) selected @endif>Active</option>
                      <option value="0" @if(isset($newsletter) && $newsletter->status == 0) selected @endif>Inactive</option>
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
<script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'message' );
</script>
@stop
