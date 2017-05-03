<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;

class SearchInController extends Controller
{	
    
	

	public function doSearchIn(Request $request)
    {
    	if($request->isMethod('get'))
    	{
    		return view ('content.search-edit');		
    	}

    	if($request->isMethod('post'))
    	{
    		if($request)
      		{	
		        unset($request['_token']);
		        unset($request['action']);
		        unset($request['save_me']);
		        unset($request['save']);
		        $data = $request->all();
		        foreach ($data as $key => $value) 
		        	if(is_array($value)) $data[$key] = implode(',',$value);
		        		        
			    $flag = DB::table('user_search')->insertGetId($data);
		        if($flag > 0)
		          return redirect('/search-edit?id='.$data['user_id'])->with('success','Record inserted!');
		        else
		          return redirect('/search-edit')->with('danger','Record not inserted!');
		    } 
    	}
    }
    
	public function index()
    {
      	$result = DB::table('user_search')->where('user_id',1)->get();
      	return view('search-edit')->with('result',$result);
    }

    public function doProfileAbout(Request $request)
    {
    	if($request->isMethod('get'))
    	{
             $added = DB::table('user_connections')
                  ->where('manage_users_id',session::get('id'))
                  ->where('added_user_id',$request->input('id'))
                  ->first();
        $winked = DB::table('user_connections')
                  ->where('manage_users_id',session::get('id'))
                  ->where('wink_user_id',$request->input('id'))
                  ->first();
        return view ('content.profile-about')->with([
            'added'=>$added,
            'winked'=>$winked
          ]);
    		
    	}
		if($request->isMethod('post'))
		{
			if($request['action'] == 'viewer')
			{

			  $data = $request->all();
			  unset($data['_token']);
			  unset($data['action']);
			 
			  $flags = DB::table('view_profiles')->insertGetId($data);
			  return response()->json($flags);
			}
		}
    }

 }   

  