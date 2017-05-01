@extends('admin/layout/layout')
@section('content')
<style>
.align {margin-top: 5px;margin-right: 10px;}
</style>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="{{url('/admin/manage-admin/admin-list')}}" class="current">Email Template List</a> </div>
  </div>
  @if (session('error'))
    <div class="alert alert-error">
      {{ session('error') }}
    </div>
  @endif
  @if (session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Email Template List</h5>
            <div class="pull-right">
              <a class="btn btn-inverse btn-mini align" href="{{url('/admin/email-template/add-new-template')}}?action=add">Add New Email Template</a>
            </div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Template Name</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!EMPTY($template_list))
                  <?php $i=1; ?>
                  @foreach($template_list as $template)
                    <tr class="gradeX">
                      <td>{{$i++}}</td>
                      <td><a href="#{{$template->name}}" data-toggle="modal">{{$template->name}}</a></td>
                      <?php
                          $created_by = \DB::table('users')->where('id',$template->created_by)->first();
                      ?>
                      <td>{{$created_by->name}}</td>
                      <td class="center">@if($template->status == 1) Active @else Inactive @endif</td>
                      <td class="center">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn dropdown-toggle">Click<span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="{{url('/admin/email-template/add-new-template')}}?action=edit&id={{$template->id}}">Edit</a></li>
                            <li><a href="{{url('/admin/email-template/add-new-template')}}?action=delete&id={{$template->id}}">Delete</a></li>
                            <!-- <li class="divider"></li>
                            <li><a href="{{--url('/admin/user/add-new-user')--}}?action=block&id={{--$template->id--}}">Block</a></li> -->
                          </ul>
                        </div>
                      </td>
                      <div id="{{$template->name}}" class="modal hide">
                        <div class="modal-header">
                          <button data-dismiss="modal" class="close" type="button">×</button>
                          <h3>{{$template->name}} Content</h3>
                        </div>
                        <div class="modal-body">
                          {!!$template->content!!}
                        </div>
                      </div>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{Request::root()}}/assets/admin/js/jquery.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.ui.custom.js"></script>
<script src="{{Request::root()}}/assets/admin/js/bootstrap.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.gritter.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.uniform.js"></script>
<script src="{{Request::root()}}/assets/admin/js/select2.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/jquery.dataTables.min.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.js"></script>
<script src="{{Request::root()}}/assets/admin/js/matrix.tables.js"></script>
@stop
