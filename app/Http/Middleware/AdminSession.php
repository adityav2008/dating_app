<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class AdminSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::id() > 0)
      {
          //$admin = DB::table  
          return redirect('/admin/login')->with('error', 'Please Login to Continue');
      }
      else
      {
        return $next($request);
      }

    }
}


<?php
