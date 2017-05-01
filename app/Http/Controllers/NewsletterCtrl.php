<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class NewsletterCtrl extends Controller
{
    
public function index(Request $request)
    {
      $newsletter_list = DB::table('newsletters')->get();
      return view('admin.content.newsletter_list')->with('newsletter_list',$newsletter_list);
    }

    public function addNewsletter(Request $request)
    {

      if($request->input('action') == 'add')
      {
         return view('admin.content.edit_newsletter')->with('action','add');
      }
      
      if($request->input('action') == 'edit')
      {
       
        $newsletter = DB::table('newsletters')->where('id',$request->input('id'))->first();
        return view('admin.content.edit_newsletter')->with('newsletter',$newsletter);
      }

      if($request->input('action') == 'delete')
      {
       
        $flag = DB::table('newsletters')->where('id',$request->input('id'))->delete();
        if($flag > 0)
          return redirect('/admin/newsletter/newsletter-list')->with('success',"Newsletter Successfully Deleted.");
        else
          return redirect('/admin/newsletter/newsletter-list')->with('error',"Internal Error Occured");
      }
    }

    public function doNewsletter(Request $request)
    {
      $data = $request->all();
      if($request->input('action') == 'add')
      {
        unset($data['_token']);
        unset($data['action']);
        
        Validator::make($request->all(), [
            'name' => 'required|unique:newsletters'
            
        ])->validate();
        
        $flag = DB::table('newsletters')->insertGetId($data);
          if($flag > 0)
            return redirect('/admin/newsletter/newsletter-list')->with('success','Newsletter successfully added');
          else
            return redirect('/admin/newsletter/newsletter-list')->with('success','Internal Server Error Occured');
      }

      if($request->input('action') == 'edit')
      {
        unset($data['_token']);
        unset($data['action']);
        unset($data['id']);
        $flag = DB::table('newsletters')->where('id',$request->input('id'))->update($data);
        if($flag > 0)
          return redirect('/admin/newsletter/newsletter-list')->with('success','Newsletter successfully updated');
        else
          return redirect('/admin/newsletter/newsletter-list')->with('success','Internal Server Error Occured');
      }
    }

}    
