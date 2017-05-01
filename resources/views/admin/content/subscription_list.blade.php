@extends('admin/layout/layout')
@section('content')
<style>
.align {margin-top: 5px;margin-right: 10px;}
</style>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="{{url('/admin/user/user-list')}}" class="current">Subscription List</a> </div>
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
            <h5>Subscription List</h5>
            <div class="pull-right">
              <a class="btn btn-inverse btn-mini align" href="{{url('/admin/subscription/add-new-subscription')}}?action=add">Add New Subscription</a>
            </div>
          </div>
          <div class="widget-content nopadding">
            <!-- {{$user_list}} -->
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Action</th>
                  <!-- <th>Delete</th> -->
                </tr>
              </thead>
              <tbody>

                @foreach($user_list as $obj)
                  <tr class="gradeX">
                  <td>{{$obj -> id}}</td>
                  <td>{{$obj -> name}}</td>
                  <td>{{$obj -> time}}</td>
                  <td class="center">{{$obj -> status}}</td>

                  <td class="btn-group">
                    <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret">
                    </span></button>
                    <ul class="dropdown-menu">
                      <li><a href="{{url('/admin/subscription/add-new-subscription')}}?id={{$obj->id}}">Edit</a>
                      </li>
                      <li class="divider"></li>
                      <li><a href="{{url('/admin/subscription/delete-subscription')}}/{{$obj->id}}" id="del_box">Delete</a></li>                   
                    </ul>
                  </td>

                  <!-- <td class="center"><button class="btn btn-info" name="edit" id="edit" data-value="{{$obj->id}}">Edit</button></td> -->
                  <!-- <td class="center"><button class="btn btn-warning" name="delete" id="delete" data-value="{{$obj->id}}">Delete</button></td> -->
                </tr>
                @endforeach

                
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#del_box').click(function()){
      confirm("Are you sure?");
    });
  });
</script>
@stop
