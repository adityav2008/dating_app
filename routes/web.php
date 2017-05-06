<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//front End  Routes

Route::get('/',function(){
  return view('content.index');
});

Route::get('/index',function(){
  return view('content.index');
});

Route::get('/contact',function(){
  return view('content.contact');
});


Route::get('/messages',function(){
  return view('content.messages');
});

// Route::get('/carousel',function(){
//   return view('content.carousel');
// });

Route::get('/connection',function(){
  return view('content.connection');
});

Route::get('/profile',function(){
  return view('content.profile');
});

// Route::get('/profile-search',function(){
//   return view('content.profile-search');
// });

// Route::get('/views',function(){
//   return view('content.views');
// });

// Route::get('/online-now',function(){
//   return view('content.views');
// });


Route::get('/about',function(){
  return view('content.about');
});

//prashant kumar
Route::auth();

Route::post('/index', 'UserCtrl@doSignUp');

Route::any('/online-now', 'UserCtrl@getOnline');

Route::any('/carousel', 'UserCtrl@getMatch');

Route::any('/views', 'UserCtrl@getOnline');

Route::any('/profile-search', 'UserCtrl@getSearch');

Route::any('/search-edit', 'SearchInController@doSearchIn');

Route::any('/profile-about', 'SearchInController@doProfileAbout');

Route::any('/new-account', 'UserCtrl@doUp');

Route::any('/header_outer', 'UserCtrl@doLogIn');

Route::any('/profile', 'UserCtrl@getUserProfile');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::any('/profile-detail', 'UserCtrl@doBlock');

//for payment.
Route::get('payment-details','PaypalController@index');
Route::post('payment-details','PaypalController@getCardInfo');
Route::get('payment-gateway','PaypalController@splitPayTrip');
//end payment.
Route::get('/account-setting/{id?}', 'Front\AccountSettingController@index');
Route::get('/account-setting/payment-methods/{id?}', 'Front\AccountSettingController@payment_method');

  Route::group(array('before' => 'auth'), function() {
      Route::get('header_inner', 'UserCtrl@getSignOut');
  });



// Admin Routes
Route::get('admin', 'Auth\LoginController@showLoginForm');
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register', 'Auth\RegisterController@register');
Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');
Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard',"DashboardCtrl@index");
    Route::group(['prefix' => 'user'], function () {
      Route::get('user-list',"UserCtrl@index");
      Route::get('add-new-user',"UserCtrl@changeUser");
      Route::post('add-new-user',"UserCtrl@doChangeUser");
      Route::group(['prefix' => 'media'], function () {
        Route::get('photos/{user_id?}',"UserCtrl@photos_list");
        Route::post('action',"UserCtrl@user_action");
      });
    });

    Route::group(['prefix' => 'manage-admin'], function () {
      Route::get('admin-list',"AdminCtrl@index");
      Route::get('add-new-admin',"AdminCtrl@changeAdmin");
      Route::post('add-new-admin',"AdminCtrl@doChangeAdmin");
    });

    Route::group(['prefix' => 'email-template'], function () {
      Route::get('email-template-list',"EmailTemplateCtrl@index");
      Route::get('add-new-template',"EmailTemplateCtrl@changeTemplate");
      Route::post('add-new-template',"EmailTemplateCtrl@doChangeTemplate");
    });

    Route::group(['prefix' => 'subscription'], function () {
      Route::get('subscription-list',"SubscriptionCtrl@index");
      Route::get('add-new-subscription',"SubscriptionCtrl@changeSubscription");
      Route::post('add-new-subscription',"SubscriptionCtrl@doChangeSubscription");
      Route::get('delete-subscription/{id}',"SubscriptionCtrl@deleteSubscription");
    });

  Route::group(['prefix' => 'newsletter'], function () {
      Route::get('newsletter-list',"NewsletterCtrl@index");
      Route::get('add-new-newsletter',"NewsletterCtrl@addNewsletter");
      Route::post('add-new-newsletter',"NewsletterCtrl@doNewsletter");

    });

  });

});
