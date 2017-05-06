<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountSettingController extends Controller
{
    public function index(Request $request)
    {
      return view('content.account-setting');
    }

    public function payment_method(Request $request)
    {
      return view('content.payment-method');
    }
}
