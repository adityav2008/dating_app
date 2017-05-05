<?php

namespace App\Http\Controllers\Auth;

use App\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use App\SocialProvider;
use App\manage_users;
use Auth;
use Session;
use DB;
use Intervention\Image\Image;
use Illuminate\Http\File;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return Admins::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectToProvider($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            unset($socialUser->user['link']);
            unset($socialUser->user['id']);
            $user = manage_users::firstOrCreate(['email' => $socialUser->getEmail(),'name'  => $socialUser->getName(),'image' => $socialUser->getAvatar(),'gender'=> $socialUser['gender'],'verified' => $socialUser['verified'] ]  );
            $path = $socialUser->getAvatar();
            $filename = basename($path);
            $user->socialProviders()->create([
                                                'provider_id' => $socialUser->getId(),
                                                'provider' => $provider
                                              ]);
            Session::put('id', $user['id']);
            return redirect('new-account?id='.$user['id'])->with('success','Record inserted!');
        }
        else
        {
            $user = $socialProvider->user;
            auth()->login($user);
            return redirect('new-account?id='.$user['id']);
        }
    }
}
