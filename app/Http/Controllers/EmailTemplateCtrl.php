<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class EmailTemplateCtrl extends Controller
{
    public function index(Request $request)
    {
      $template_list = DB::table('email_templates')->get();
      return view('admin.content.email_template_list')->with('template_list',$template_list);
    }

    public function changeTemplate(Request $request)
    {
      if($request->input('action') == 'add')
      {
        return view('admin.content.edit_email_template');
      }

      if($request->input('action') == 'edit')
      {
        $template = DB::table('email_templates')->where('id',$request->input('id'))->first();
        return view('admin.content.edit_email_template')->with('template',$template);
      }

      if($request->input('action') == 'delete')
      {
        $flag = DB::table('email_templates')->where('id',$request->input('id'))->delete();
        if($flag > 0)
          return redirect('/admin/email-template/email-template-list')->with('success','Email Template successfully Deleted');
        else
          return redirect('/admin/email-template/email-template-list')->with('success','Internal Server Error Occured');
      }
    }

    public function doChangeTemplate(Request $request)
    {
      $data = $request->all();
      if($request->input('action') == 'add')
      {
        unset($data['_token']);
        unset($data['action']);
        $data['content'] = $data['email_content'];
        unset($data['email_content']);
        Validator::make($request->all(), [
            'name' => 'required|unique:email_templates',
            'email_content' => 'required'
        ])->validate();
        $data['created_by'] = \Auth::user()->id;
        $flag = DB::table('email_templates')->insertGetId($data);
        if($flag > 0)
          return redirect('/admin/email-template/email-template-list')->with('success','New Email Template successfully added.');
        else
          return redirect('/admin/email-template/email-template-list')->with('success','Internal Server Error Occured.');

      }
      if($request->input('action') == 'edit')
      {
        unset($data['_token']);
        unset($data['action']);
        $data['content'] = $data['email_content'];
        unset($data['email_content']);
        unset($data['id']);
        Validator::make($request->all(), [
            'name' => 'required',
            'email_content' => 'required'
        ])->validate();
        $data['created_by'] = \Auth::user()->id;
        $flag = DB::table('email_templates')->where('id',$request->input('id'))->update($data);
        if($flag > 0)
          return redirect('/admin/email-template/email-template-list')->with('success','New Email Template successfully added.');
        else
          return redirect('/admin/email-template/email-template-list')->with('success','Internal Server Error Occured.');
      }
    }

}
