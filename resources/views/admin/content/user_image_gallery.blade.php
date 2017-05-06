@extends('admin/layout/layout')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Sample pages</a> <a href="#" class="current">Gallery</a> </div>
    <h1>Gallery</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
            <h5>Gallery</h5>
          </div>

          <div class="widget-content">
            @if(!EMPTY($image_list))
            <ul class="thumbnails">
              @foreach($image_list as $image)
              <li class="span2">
                <a>
                  <img src="{{Request::root()}}{{$image->image}}" alt="" >
                </a>
                <div class="actions">
                  <a class="lightbox_trigger" href="{{Request::root()}}{{$image->image}}">
                    <i class="icon-search"></i>
                  </a>
                </div>
                @if($image->status == 0)
                <div class="approve-btn">
                  <button class="btn btn-danger btn-mini not-varified" data-value="{{$image->id}}">Not Verified</button>
                </div>
                @else
                <div class="approve-btn">
                  <button class="btn btn-success btn-mini varified" data-value="{{$image->id}}">Verified</button>
                </div>
                @endif
              </li>
              @endforeach
            </ul>
            @endif
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
<script>

$(document).on('click','.not-varified',function(){
  var image_id = $(this).data('value');
  $.ajax({
    type:'post',
    url:"{{Request::root()}}/admin/user/media/action",
    dataType:'json',
    data:{
      image_id : image_id,
      action : 'varified',
      _token:'{{csrf_token()}}'
    },
    success: function(result){
      if(result == 0 )
      {
        swal(
          'Oops...',
          'Try Again later..',
          'error'
        )
      }
      else
      {
        swal(
          'Success...',
          'Image Successfully Approved.',
          'success'
        );
        // $(this).html('Verified');
        // $(this).removeClass('btn-success').addClass('btn-danger').removeClass('not-varified').addClass('varified');
        setTimeout(function(){
          location.reload();
        },2000)

      }
    }
  });
});
$(document).on('click','.varified',function(){
  var image_id = $(this).data('value');
  $.ajax({
    type:'post',
    url:"{{Request::root()}}/admin/user/media/action",
    dataType:'json',
    data:{
      image_id : image_id,
      action : 'not-varified',
      _token:'{{csrf_token()}}'
    },
    success: function(result){
      if(result == 0 )
      {
        swal(
          'Oops...',
          'Try Again later..',
          'error'
        )
      }
      else
      {
        swal(
          'Success...',
          'Image Blocked for Offensive Content',
          'error'
        );
        // $(this).html('Not Verified');
        // $(this).removeClass('btn-danger').addClass('btn-success').removeClass('varified').addClass('not-varified');
        setTimeout(function(){
          location.reload();
        },2000)
      }
    }
  });
});
</script>
@endsection
