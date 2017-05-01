<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>

    <li class="@if(Request::segment(2) == 'dashboard') active @endif">
      <a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a>
    </li>

    <li class="@if(Request::segment(2) == 'manage-admin') active @endif">
      <a href="{{url('/admin/manage-admin/admin-list')}}"><i class="icon icon-home"></i> <span>Manage Admin</span></a>
    </li>

    <li class="submenu @if(Request::segment(2) == 'user') active @endif">
      <a href="#"><i class="icon icon-th-list"></i><span>Manage User</span></a>
      <ul>
        <li><a href="{{url('/admin/user/user-list')}}">View User's</a></li>
        <!-- <li><a href="{{url('/admin/user/blocked-users')}}">Blocked Users</a></li> -->
      </ul>
    </li>

    <li class="submenu @if(Request::segment(2) == 'subscription') active @endif"><a href="#"><i class="icon icon-th-list"></i> <span>Manage Subscription </span></a>
      <ul>
        <li><a href="{{url('/admin/subscription/subscription-list')}}">View Plan</a></li>
        <li><a href="{{url('/admin/subscription/add-new-subscription')}}?action=add">Create New Plan</a></li>
      </ul>
    </li>

    <li class="submenu"><a href="#"><i class="icon icon-th-list"></i> <span>Manage Payment </span></a>
      <ul>
        <li><a href="#">View Plan</a></li>
        <li><a href="#">Create New Plan</a></li>
        <li><a href="#">Payment Report</a></li>
      </ul>
    </li>

    <!-- <li class="submenu"><a href="#"><i class="icon icon-th-list"></i> <span>Manage Membership</span></a>
      <ul>
        <li><a href="#">View Membership</a></li>
        <li><a href="#">Create New Membership</a></li>
      </ul>
    </li> -->

    <li class="submenu @if(Request::segment(2) == 'newsletter') active @endif"><a href="#"><i class="icon icon-th-list"></i> <span>Manage Newsletter</span></a>
      <ul>
        <li><a href="{{url('/admin/newsletter/newsletter-list')}}">View Newsletter</a></li>
        <li><a href="{{url('/admin/newsletter/add-new-newsletter')}}?action=add">Create New Newsletter</a></li>
      </ul>
    </li>

    <li class="submenu @if(Request::segment(2) == 'email-template') active @endif"><a href="#"><i class="icon icon-th-list"></i> <span>Manage Email Template</span></a>
      <ul>
        <li><a href="{{url('/admin/email-template/email-template-list')}}">View Email Template</a></li>
        <li><a href="{{url('/admin/email-template/add-new-template')}}?action=add">Create New Template</a></li>
      </ul>
    </li>

    <li class="submenu"><a href="#"><i class="icon icon-th-list"></i> <span>CMS</span></a>
      <ul>
        <li><a href="#">Manage Header</a></li>
        <li><a href="#">Manage Footer</a></li>
        <li><a href="#">Manage Homepage Banner</a></li>
        <li><a href="#">Manage About us</a></li>
        <li><a href="#">Manage Contact us</a></li>
      </ul>
    </li>
  </ul>
</div>
<!--sidebar-menu-->
