<div class="left-menu">

  <ul>

    <li class="@if(Request::segment(1)== 'profile-search') active @endif">
        <a href="{{url('/profile-search?id=')}}{{ $_GET['id'] }}"><i class="fa fa-search" aria-hidden="true"></i>Search</a>

    </li>

    <li class="@if(Request::segment(1)== 'carousel') active @endif">

      <a href="{{url('/carousel?id=')}}{{ $_GET['id'] }}"><i class="fa fa-users" aria-hidden="true"></i>Carousel</a>

    </li>

    <li class="@if(Request::segment(1)== 'online-now') active @endif">

      <a href="{{url('/online-now?id=')}}{{ $_GET['id'] }}"><i class="fa fa-wechat" aria-hidden="true"></i>Online Now</a>

    </li>

    <li class="@if(Request::segment(1)== 'messages') active @endif">

      <a href="{{url('/messages?id=')}}{{ $_GET['id'] }}"><i class="fa fa-envelope" aria-hidden="true"></i>Messages</a>

    </li>

    <li class="@if(Request::segment(1)== 'connection') active @endif">

      <a href="{{url('/connection?id=')}}{{ $_GET['id'] }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Connections</a>

    </li>

    <li class="@if(Request::segment(1)== 'views') active @endif">

      <a href="{{url('/views?id=')}}{{ $_GET['id'] }}"><i class="fa fa-eye" aria-hidden="true"></i>Views</a>

    </li>

    <li class="">

      <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Insights</a>

    </li>

  </ul>

  <a class="green-btn" href="#"><i class="fa fa-unlock" aria-hidden="true"></i> Subscribe</a>

</div>

