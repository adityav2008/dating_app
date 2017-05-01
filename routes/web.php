<?php
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
Route::get('/carousel',function(){
  return view('content.carousel');
});
Route::get('/connection',function(){
  return view('content.connection');
});
Route::get('/profile',function(){
  return view('content.profile');
});
Route::get('/profile-search',function(){
  return view('content.profile-search');
});
Route::get('/views',function(){
  return view('content.views');
});
Route::get('/online-now',function(){
  return view('content.views');
});
Route::get('/about',function(){
  return view('content.about');
});
//prashant kumar
Route::auth();

Route::post('/index', 'UserCtrl@doSignUp');

Route::any('/search-edit', 'SearchInController@doSearchIn');

Route::any('/profile-about', 'SearchInController@doProfileAbout');

Route::any('/new-account', 'UserCtrl@doUp');

Route::any('/header_outer', 'UserCtrl@doLogIn');

Route::any('/profile', 'UserCtrl@getUserProfile');

Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Route::any('/profile-detail', 'UserCtrl@doBlock');

Route::group(array('before' => 'auth'), function() {

    Route::get('header_inner', 'UserCtrl@getSignOut');

});


// Admin Section Routes
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
  Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard',"DashboardCtrl@index");
    Route::group(['prefix' => 'user'], function () {
      Route::get('user-list',"UserCtrl@index");
      Route::get('add-new-user',"UserCtrl@changeUser");
      Route::post('add-new-user',"UserCtrl@doChangeUser");
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
