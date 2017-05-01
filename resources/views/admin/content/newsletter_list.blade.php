@extends('admin/layout/layout')
@section('content')
<style>
.align {margin-top: 5px;margin-right: 10px;}
</style>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="{{url('/admin/newsletter/newsletter-list')}}" class="current">Newsletter List</a> </div>
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
            <h5>Newsletter List</h5>
            <div class="pull-right">
              <a class="btn btn-inverse btn-mini align" href="{{url('/admin/newsletter/add-new-newsletter')}}?action=add">Add New Newsletter</a>
            </div>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Newsletter Name</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!EMPTY($newsletter_list))
                  <?php $i=1; ?>
                  @foreach($newsletter_list as $newsletter)
                    <tr class="gradeX">
                      <td>{{$i++}}</td>
                      <td>{{$newsletter->name}}</td>
                      <td>{!!$newsletter->message!!}</td>
                      <td class="center">@if($newsletter->status == 1) Active @else Inactive @endif</td>
                      <td class="center">
                        <div class="btn-group">
                          <button data-toggle="dropdown" class="btn dropdown-toggle">Click<span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="{{url('/admin/newsletter/add-new-newsletter')}}?action=edit&id={{$newsletter->id}}">Edit</a></li>
                            <li><a href="{{url('/admin/newsletter/add-new-newsletter')}}?action=delete&id={{$newsletter->id}}">Delete</a></li>
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
<script src="{{Request::root()}}/assets/admin/js/bootstrap-wysihtml5.js"></script> 
@stop
