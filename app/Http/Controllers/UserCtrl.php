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

// sendMsg
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

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
       // dd($data);
        $Y = $data['year'];
        $m = $data['month'];
        $d = $data['day'];

        unset($data['month']);
        unset($data['year']);
        unset($data['day']);
        unset($data['_token']);
        unset($data['action']);
        //formating date 
        
        $date = $Y."-".$m."-".$d;
        $data['dob'] = date("Y-m-d",strtotime($date));


        //geting age in years
        $dateOfBirth = $data['dob'];
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));

        $data['age'] = $diff->format('%y');
      
        Validator::make($request->all(), [
            'email' => 'required|unique:manage_users'
        ])->validate();
        $flag = DB::table('manage_users')->insertGetId($data);

        Session::put('id', $flag);

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
          return redirect('/profile-search?id='.$data['id'])->with('success','New user successfully updated');
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
            //update last seen and online status
            $flag = DB::table('manage_users')->where('id',array(Session::get('id')))->update(['last_seen'=> date('Y-m-d h:i:s'),'online_status' => 1]);
            return Redirect::to('profile?id='.$user_id);
        
        }

          

        }



    }
    // 12 apr 2017
    // Profile.blade.php 
    public function getUserProfile(Request $request)
    {

      if($request->isMethod('get'))
      {
        return view ('content.profile');
      }
      //edit user name in profile
      if($request->isMethod('post'))
      {
        if($request['action'] == 'update_name')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);

          $flag = DB::table('manage_users')->where('id',$data['manage_users_id'])->update(['name'=> $data['user_name']]);

          return response()->json($flag);
        }
      }
      //edit user age in profile 
      if($request->isMethod('post'))
      {
        if($request['action'] == 'update_dob')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          //geting age in years
          $dateOfBirth = $data['dob'];
          $today = date("Y-m-d");
          $diff = date_diff(date_create($dateOfBirth), date_create($today));
          $data['age'] = $diff->format('%y');

          $flag = DB::table('manage_users')->where('id',$data['manage_users_id'])->update(['dob'=> $dateOfBirth , 'age' => $data['age']]);

          return response()->json($flag);
        }
      }

      //edit user location in profile 
      if($request->isMethod('post'))
      {
        if($request['action'] == 'update_location')
        {
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
         
          $flag = DB::table('manage_users')->where('id',$data['manage_users_id'])->update(['location'=> $data['location']]);

          return response()->json($flag);
        }
      }

      //edit user image in profile 
      if($request->isMethod('post'))
      {
        if($request['action'] == 'add_image')
        {
          
          $data = $request->all();
          unset($data['_token']);
          unset($data['action']);
          $fileName = explode('C:\fakepath\\', $data['image']);

          //$imagePath = $data['image']->move(public_path('images'), $fileName);
          //dd($imagePath);
          $flag = $flag = DB::table('user-images')->insertGetId($data);

          return response()->json($flag);
        }
      }

    }

    public function getSignOut() {

    //update last seen and online status
    $flag = DB::table('manage_users')->where('id',Session::get('id'))->update(['last_seen'=> date('Y-m-d h:i:s'),'online_status' => 0]);

    Auth::logout();
    Session::flush();
    
            
    return Redirect::to('/');

    }

    public function doBlock(Request $request)
    {
      if($request->isMethod('get'))
      {
        
          if(isset($_GET['search']))
           {
              $autoSearches = DB::table('user_search')
                      ->where('user_id',Session::get('id'))
                      ->where('search_name',$_GET['search'])
                      ->get();

           }
           else
           {

            $autoSearches = DB::table('user_search')
                      ->where('user_id',Session::get('id'))
                      // ->where('search_name',$_GET['search'])
                      ->get();
                      

            if(count($autoSearches) > 1){
             $autoSearches = DB::table('user_search')
                       ->where('user_id',Session::get('id'))
                       ->take(1)
                       ->get();
            }
          } 

        $added = DB::table('user_connections')
                  ->where('manage_users_id',session::get('id'))
                  ->where('added_user_id',$request->input('id'))
                  ->first();
        $winked = DB::table('user_connections')
                  ->where('manage_users_id',session::get('id'))
                  ->where('wink_user_id',$request->input('id'))
                  ->first();
        return view ('content.profile-detail')->with([
            'added'=>$added,
            'winked'=>$winked,
            'search'=>$autoSearches
          ]);
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

    public function getOnline(Request $request){

      if($request->isMethod('get'))
      {
        $result = DB::table('manage_users')
                      ->whereNotIn('id',array(session::get('id')))
                      ->where('status', '!=' , 0)
                      ->where('online_status','!=', 0)
                      ->paginate(1);

        // current online users 
        $online = DB::table('manage_users')
                      ->whereNotIn('id',array(session::get('id')))
                      ->where('status', '!=' , 0)
                      ->where('online_status','!=', 0)
                      ->get();              

        // recently online users 
        $recent = DB::table('manage_users')
                      ->whereNotIn('id',array(session::get('id')))
                      ->where('status', '!=' , 0)
                      ->where('last_seen','!=', 0)
                      ->get();              

        $views = DB::table('view_profiles')
                  ->whereNotIn('id',array(session::get('id')))
                  ->get();

        return view('content.views')->with([
            'result'=>$result,
            'views'=> $views,
            'online'=>$online,
            'recent'=>$recent
          ]);
      }
    }

    public function getViews(Request $request){

      if($request->isMethod('get'))
      {
        
    
        return view('content.views');

      }

      if($request->isMethod('post'))
      {
      //
      }
    }

  public function getMatch(Request $request)
  {

    if($request->isMethod('get'))
      {
       
        $return = DB::table('manage_users')
                    ->whereNotIn('id',array(Session::get('id')))
                    ->get(); 
        
        return view('content.carousel')->with(['values' => $return]);
       //return view('content.carousel');
      }
  }

  public function getSearch(Request $request){
    if($request->isMethod('get'))
    {
      if(isset($_GET['search']))
       {
          $auto_Search = DB::table('user_search')
                  ->where('user_id',Session::get('id'))
                  ->where('search_name',$_GET['search'])
                  ->get();

       }
       else
       {

        $auto_Search = DB::table('user_search')
                  ->where('user_id',Session::get('id'))
                  // ->where('search_name',$_GET['search'])
                  ->get();
                  

        if(count($auto_Search) > 1){
         $auto_Search = DB::table('user_search')
                   ->where('user_id',Session::get('id'))
                   ->take(1)
                   ->get();
        }
      }
       


      // if(count($filter) > 0)
      // {
      //   $user_default_match = DB::table('manage_users')
      //                       ->where('id',array(Session::get('id')))
      //                       ->get();
      //   foreach ($user_default_match as $value)
      //   {
      //       $res_for   = $value->looking_for;
      //       $res_Age   = $value->age;
      //       $res_Location   = $value->location;
      //       $res_Height   = $value->height;
      //       $res_relationship   = $value->relationship;
      //       $res_children   = $value->children;
      //       $res_education   = $value->education;
      //       $res_ethnicity   = $value->ethnicity;
      //       $res_religion   = $value->religion;
      //       $res_bodyType   = $value->body_type;
      //       $res_smoke   = $value->smoking;
            
      //   }

      //   $autoSearch = DB::table('manage_users')
      //                 ->whereNotIn('id',array(Session::get('id')))
      //                 ->where('gender',$res_for)
      //                 ->where('age', $res_Age)
      //                 ->where('height',$res_Height)
      //                 ->where('relationship',$res_relationship)
      //                 ->where('children',$res_children)
      //                 ->where('education',$res_education)
      //                 ->where('ethnicity',$res_ethnicity)
      //                 ->where('religion',$res_religion)
      //                 ->where('body_type',$res_bodyType)
      //                 ->where('smoking',$res_smoke)
      //                 ->get();
      //   dd($autoSearch);
      // }

      return view('content.profile-search')->with([
        'search' => $auto_Search
        ]);
    }
  }

  public function sendMsg(Request $request){
    if($request->isMethod('get'))
      {

        $send_message = DB::table('user_connections')
                 ->where('messanger_id',array(Session::get('id')))
                 ->get();

         //$id = $send_message[0]->messanger_id;
         //dd($send_message); 
       for($i=0;count($send_message) > $i;$i++) 
       {
         $send_to[] = $send_message[$i]->manage_users_id;
       }
       
        for($j = 0; count($send_to) > $j; $j++)
        {
          $reciver[$j] = DB::table('manage_users')
                   ->where('id',$send_to[$j])
                   ->get();
                  
        }

        
       // $optionBuiler = new OptionsBuilder();
          // $optionBuiler->setTimeToLive(60*20);

          // $notificationBuilder = new PayloadNotificationBuilder('my title');
          // $notificationBuilder->setBody('Hello world')
          //             ->setSound('default');
                      
          // $dataBuilder = new PayloadDataBuilder();
          // $dataBuilder->addData(['a_data' => 'my_data']);

          // $option = $optionBuiler->build();
          // $notification = $notificationBuilder->build();
          // $data = $dataBuilder->build();

          // $token = "123456";

          // $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

          // $downstreamResponse->numberSuccess();
          // $downstreamResponse->numberFailure();
          // $downstreamResponse->numberModification();

          // //return Array - you must remove all this tokens in your database
          // $downstreamResponse->tokensToDelete(); 

          // //return Array (key : oldToken, value : new token - you must change the token in your database )
          // $downstreamResponse->tokensToModify(); 

          // //return Array - you should try to resend the message to the tokens in the array
          // $downstreamResponse->tokensToRetry();

          // return Array (key:token, value:errror) - in production you should remove from your database the tokens
    
        return view('content.messages')->with([
          'send'=>$send_message,
          'reciver'=>$reciver
          ]);

      }

      if($request->isMethod('post'))
      {
      //
      }

  }
}
