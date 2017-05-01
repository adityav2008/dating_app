<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
class AdminCtrl extends Controller
{
    public function index(Request $request)
    {
      $admin_list = DB::table('users')->where('parent_id','<>',0)->get();
      return view('admin.content.admin_list')->with('admin_list',$admin_list);
    }

    public function changeAdmin(Request $request)
    {
      if($request->input('action') == 'add')
      {
          return view('admin.content.edit_admin');
      }

      // if($request->input('action') == 'edit')
      // {
      //   dd($request->all());
      // }

      if($request->input('action') == 'delete')
      {
        $flag = DB::table('users')->where('id',$request->input('id'))->delete();
        if($flag > 0)
          return redirect('/admin/manage-admin/admin-list')->with('success','Admin successfully Deleted');
        else
          return redirect('/admin/manage-admin/admin-list')->with('success','Internal Server Error Occured');
      }

      if($request->input('action') == 'reset-password')
      {
        $admin = DB::table('users')->where('id',$request->input('id'))->first();
        $password = $this->generateRandomString(8);
        $data['password'] = bcrypt($password);
        $flag = DB::table('users')->where('id',$request->input('id'))->update($data);
        $data = array(
          'subject' => "Reset Password",
          'pwd' => $password,
          'to' => $admin->email,
          'from' => \Auth::user()->email,
          'from_name' => config('app.name')
          );

        \Mail::send('admin.email.send_password', $data, function ($message) use ($data) {
         $message->getHeaders()->addTextHeader('From: '.$data['from_name'].' <'.$data['from'].'>'."\r\n".'Reply-To:'.$data['from']."\r\n".'X-Mailer: PHP/' . phpversion(), true);
         $message->from($data['from'],$data['from_name']);
         $message->to($data['to'])->subject($data['subject']);
         });
        return redirect('/admin/manage-admin/admin-list')->with('success','Password successfully Reset and Emailed on admin Email ID');
      }

    }

    public function doChangeAdmin(Request $request)
    {
      $data = $request->all();
      if($request->input('action') == 'add')
      {
        unset($data['_token']);
        unset($data['action']);
        Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ])->validate();
        $password = $this->generateRandomString(8);
        $data['password'] = bcrypt($password);
        $data['created_by'] = \Auth::user()->id;
        $data['parent_id'] = \Auth::user()->id;
        $flag = DB::table('users')->insertGetId($data);
        if($flag > 0)
        {
          $data = array(
            'subject' => "New Account",
            'pwd' => $password,
            'to' => $data['email'],
            'from' => \Auth::user()->email,
            'from_name' => config('app.name')
            );

          \Mail::send('admin.email.send_password', $data, function ($message) use ($data) {
           $message->getHeaders()->addTextHeader('From: '.$data['from_name'].' <'.$data['from'].'>'."\r\n".'Reply-To:'.$data['from']."\r\n".'X-Mailer: PHP/' . phpversion(), true);
           $message->from($data['from'],$data['from_name']);
           $message->to($data['to'])->subject($data['subject']);
           });
          return redirect('/admin/manage-admin/admin-list')->with('success','New Admin successfully added and Password Emailed on admin Email ID');
        }

        else
          return redirect('/admin/manage-admin/admin-list')->with('success','Internal Server Error Occured');
      }
      if($request->input('action') == 'edit')
      {
        unset($data['_token']);
        unset($data['action']);
        unset($data['id']);
        $flag = DB::table('manage_users')->where('id',$request->input('id'))->update($data);
        if($flag > 0)
          return redirect('/admin/user/user-list')->with('success','New user successfully updated');
        else
          return redirect('/admin/user/user-list')->with('success','Internal Server Error Occured');
      }
    }

    public function generateRandomString($length) {
       $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*()?';
       $charactersLength = strlen($characters);
       $randomString = '';
       for ($i = 0; $i < $length; $i++) {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
       return $randomString;
    }

}
