<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use DB;

class DashboardCtrl extends Controller
{
    public function index(Request $request)
    {

      $total_user = DB::table('manage_users')->count();
      $total_male_user = DB::table('manage_users')->where('gender','male')->count();
      $total_female_user = DB::table('manage_users')->where('gender','female')->count();
      $total_active_user = DB::table('manage_users')->where('status',1)->count();
      $total_inactive_user = DB::table('manage_users')->where('status',0)->count();
      $total_admin = DB::table('users')->where('parent_id','<>',0)->count();
      $total_active_admin = DB::table('users')->where('parent_id','<>',0)->where('status',1)->count();
      $total_inactive_admin = DB::table('users')->where('parent_id','<>',0)->where('status',0)->count();
      return view("admin.content.index")->with([
        'total_user'=>$total_user,
        'total_male_user'=>$total_male_user,
        'total_female_user'=>$total_female_user,
        'total_active_user'=>$total_active_user,
        'total_inactive_user'=>$total_inactive_user,
        'total_admin'=>$total_admin,
        'total_active_admin'=>$total_active_admin,
        'total_inactive_admin'=>$total_inactive_admin,
      ]);

    }
}
