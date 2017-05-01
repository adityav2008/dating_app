<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;
use Validator;
use Auth;
use Session;

class UserCtrl extends Controller
{
    public function index(Request $request)
    {
      $user_list = DB::table('manage_users')->get();
      return view('admin.content.user_list')->with('user_list',$user_list);
    }

    public function changeUser(Request $request)
    {
      if($request->input('action') == 'add')
      {
        return view('admin.content.edit_user');
      }

      if($request->input('action') == 'edit')
      {
        $user = DB::table('manage_users')->where('id',$request->input('id'))->first();
        return view('admin.content.edit_user')->with('user',$user);
      }

      if($request->input('action') == 'delete')
      {
        $flag = DB::table('manage_users')->where('id',$request->input('id'))->delete();
        if($flag > 0)
          return redirect('/admin/user/user-list')->with('success','User successfully Deleted');
        else
          return redirect('/admin/user/user-list')->with('success','Internal Server Error Occured');
      }

      if($request->input('action') == 'block')
      {
        echo "<pre>";
        print_r($request->all());
      }
    }

    public function doChangeUser(Request $request)
    {
      $data = $request->all();
      if($request->input('action') == 'add')
      {
        unset($data['_token']);
        unset($data['action']);
        Validator::make($request->all(), [
            'email' => 'required|unique:manage_users'
        ])->validate();
          $flag = DB::table('manage_users')->insertGetId($data);
          if($flag > 0)
            return redirect('/admin/user/user-list')->with('success','New user successfully added');
          else
            return redirect('/admin/user/user-list')->with('success','Internal Server Error Occured');
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

// 12 apr 2017
    public function doSignUp(Request $request)
    {
    if($request->isMethod('post'))
      {
        $data = $request->all();

        $Y = $data['year'];
        $m = $data['month'];
        $d = $data['day'];

        unset($data['month']);
        unset($data['year']);
        unset($data['day']);
        unset($data['_token']);
        unset($data['action']);
        $date = date_create($Y."-".$m."-".$d);
        $data['dob'] =  date_format($date,"Y-m-d");
        $dateOfBirth = $data['dob'];
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $data['age'] = $diff->format('%y');

        Validator::make($request->all(), [
            'email' => 'required|unique:manage_users'
        ])->validate();
        $flag = DB::table('manage_users')->insertGetId($data);
          if($flag > 0)
            return redirect('/new-account?id='.$flag)->with('success','New user successfully added');
          else
            return redirect('/index.php')->with('success','Internal Server Error Occured');
        }
    }

    public function doUp(Request $request)
    {
      if($request->isMethod('get'))
      {
        return view ('content.new-account');
      }

      if($request->isMethod('post'))
      {

        if( $request->hasFile('image'))
        {
          $image = $request->file('image');
          $fileName = $image->getClientOriginalName();
          $extension = $image->getClientMimeType();
          $imagePath = $request->image->move(public_path('images'), $fileName);
        }
        else
        {
          dd('No image was found! Please upload another image');
        }

        $data = $request->all();
        $data['image'] = $fileName;
        unset($data['_token']);
        unset($data['action']);
        $flag = DB::table('manage_users')->where('id',$data['id'])->update($data);
        if($flag > 0)
          return redirect('/profile-search')->with('success','New user successfully updated');
        else
          return redirect('/new-account?id='.$data['id'])->with('success','Internal Server Error Occured');
      }
    }

    public function doLogIn(Request $request)
    {
      if($request->isMethod('get'))
      {
        return view ('common.header_outer');
      }

      if($request->isMethod('post'))
      {
        $rules = array(
                          'email'    => 'required|email', // make sure the email is an actual email
                          'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
                      );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to('index')->withErrors($validator)->withInput(Input::except('password'));
        }
        else
        {
            $data = array(
                            'email' => Input::get('email'),
                            'password' => Input::get('password')
                          );
            $values = DB::table('manage_users')->where('email',$data['email'])->first(['id']);
            $user_id = $values->id;
            Session::put('id', $user_id);
            return Redirect::to('profile?id='.$user_id);

        }



        }



    }
    // 12 apr 2017

    public function getUserProfile(Request $request)
    {

      if($request->isMethod('get'))
      {
        return view ('content.profile');
      }

      if($request->isMethod('post'))
      {
        dd($request->all());
      }
    }

    public function getSignOut() {

    Auth::logout();
    Session::flush();
    return Redirect::to('/');

    }

    public function doBlock(Request $request)
    {
      if($request->isMethod('get'))
      {
        return view ('content.profile-detail');
      }

      if($request->isMethod('post'))
      {
        if($request['action'] == 'block')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          $report = DB::table('user_reports')->insertGetId($data);
          $flag = DB::table('manage_users')->where('id',$data['manage_users_id'])->update(['status'=>'0']);
          return response()->json($flag);
        }

        if($request['action'] == 'add')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          $flags = DB::table('user_connections')->insertGetId($data);
          return response()->json($flags);
        }

        if($request['action'] == 'wink')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          $flags = DB::table('user_connections')->insertGetId($data);
          return response()->json($flags);
        }

        if($request['action'] == 'send')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          $flags = DB::table('user_connections')->insertGetId($data);
          return response()->json($flags);
        }
      }
    }

}
