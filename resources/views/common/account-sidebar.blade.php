<div class="left-menu">
  <ul>
    <li class="@if(Request::segment(2)== 'notifications') active @endif">
        <a href="{{url('/account-setting/notifications')}}/{{ Session::get('id') }}"><i class="fa fa-search" aria-hidden="true"></i>Notifications</a>
    </li>
    <li class="@if(Request::segment(2)== 'payment-methods') active @endif">
      <a href="{{url('/account-setting/payment-methods')}}/{{ Session::get('id') }}"><i class="fa fa-users" aria-hidden="true"></i>Payment Methods</a>
    </li>
    <li class="@if(Request::segment(2)== 'transaction-history') active @endif">
      <a href="{{url('/account-setting/transaction-history')}}/{{ Session::get('id') }}"><i class="fa fa-envelope" aria-hidden="true"></i>Transaction History</a>
    </li>
    <li class="@if(Request::segment(2)== 'privacy') active @endif">
      <a href="{{url('/account-setting/privacy')}}/{{ Session::get('id') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Privacy</a>
    </li>
    <li class="@if(Request::segment(2)== 'security') active @endif">
      <a href="{{url('/account-setting/security')}}/{{ Session::get('id') }}"><i class="fa fa-eye" aria-hidden="true"></i>Security</a>
    </li>
  </ul>
</div>
