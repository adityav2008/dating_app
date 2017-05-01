<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class SubscriptionCtrl extends Controller
{
	// Calling index() for subscription list.
    public function index(Request $request)
    {
      $user_list = DB::table('subscriptions')->get();
       //dd($user_list);
      return view('admin.content.subscription_list')->with([
      		'user_list'=>$user_list,
      	]);
    }

    // Calling changeSubscription for edit.
    public function changeSubscription(Request $request)
    {
    	
    //echo "Hello";	
    	// for insert data into database.

      if($request->input('action') == 'add')
      {
      	
         return view('admin.content.edit_subscription')->with('action','add');
      }
      // for select individual data from database.
      else
      {
      	$flag = DB::table('subscriptions')->where('id',$request->input('id'))->first();
     	// echo "<pre>";
    	// print_r($flag);
    	// echo "<pre>";
    	return view('admin.content.edit_subscription')->with([ 'list'=>$flag,'action'=>'update']);
      }
    }

    // Calling doChangeSubscription after submit button, 1st checck validation, than data save into database.
    public function doChangeSubscription(Request $request)
    {
    	//print_r($request->all());
    	//exit();
      $data = $request->all();
      unset($data['_token']);
      unset($data['action']);
      unset($data['id']);

      // If action is "add".
      if($request->input('action') == 'add')
      {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:subscriptions',
            'amount' => 'required|integer',
            
        ]);
         if ($validator->fails()) {
             return redirect('/admin/subscription/add-new-subscription?action=add')
                        ->withErrors($validator->errors())
                        ->withInput();
         }
         else {

          $flag = DB::table('subscriptions')->insertGetId($data);
          if($flag > 0)
            return redirect('/admin/subscription/subscription-list')->with('success','New user successfully added');
          else
            return redirect('/admin/subscription/subscription-list')->with('success','Internal Server Error Occured');
        }

      }

      // If id is given.
      else
      {
      	//echo $request->input('id');exit();
      	DB::table('subscriptions')->where('id',$request->input('id'))->update($data);
      	return redirect('/admin/subscription/subscription-list')->with('success','Record is updated successfully');
      }
    }    

    // Delete functionality here.
    public function deleteSubscription($id, Request $request){
    	echo $id;
    	$flag = DB::table('subscriptions')->where('id',$id)->delete();
          if($flag > 0)
            return redirect('/admin/subscription/subscription-list')->with('success','New user successfully added');
          else
            return redirect('/admin/subscription/subscription-list')->with('success','Internal Server Error Occured');
    }

    // Edit functionality here.
    // public function editSubscription(Request $request){
    // 	$flag = DB::table('subscriptions')->where('id',$request->input('id'))->first();
    // 	echo "<pre>";
    // 	print_r($flag);
    // 	echo "<pre>";
    // 	return redirect('/admin/subscription/add-new-subscription')->with([ 'list'=>$flag ]);
    // }
    
}
