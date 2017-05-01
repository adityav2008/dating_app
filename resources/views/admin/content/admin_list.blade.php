@extends('admin/layout/layout')
@section('content')
<style>
.align {margin-top: 5px;margin-right: 10px;}
</style>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="{{url('/admin/manage-admin/admin-list')}}" class="current">Admin List</a> </div>
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
            <h5>Admin List</h5>
            <div class="pull-right">
              <a class="btn btn-inverse btn-mini align" href="{{url('/admin/manage-admin/add-new-admin')}}?action=add">Add New Admin</a>
            </div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Admin Name</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!EMPTY($admin_list))
                  <?php $i=1; ?>
                  @foreach($admin_list as $admin)
                    <tr class="gradeX">
                      <td>{{$i++}}</td>
                      <td>{{$admin->name}}</td>
                      <?php
                          $admin_name = \DB::table('users')->where('id',$admin->created_by)->first();
                      ?>
                      <td>{{$admin_name->name}}</td>
                      <td class="center">@if($admin->status == 1) Active @else Inactive @endif</td>
                      <td class="center">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn dropdown-toggle">Click<span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="{{url('/admin/manage-admin/add-new-admin')}}?action=reset-password&id={{$admin->id}}">Reset Password</a></li>
                            <li><a href="{{url('/admin/manage-admin/add-new-admin')}}?action=delete&id={{$admin->id}}">Delete</a></li>
                            <!-- <li class="divider"></li>
                            <li><a href="{{--url('/admin/user/add-new-user')--}}?action=block&id={{--$admin->id--}}">Block</a></li> -->
                          </ul>
                        </div>
                      </td>
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
