<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::route('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/**
 * Currently check if user is in the admin group
 */
Route::filter('admin', function(){
	if (!Sentry::check()){
		Session::flash("messages",array(Lang::get('user.invalid_login')));
	    return Redirect::to('user/login');
	}
	
	$user = Sentry::user();
	if(!$user->in_group('admin')){
		Session::flash("messages",array(Lang::get('user.invalid_login')));
		return Redirect::to('user/login');
	}
});

//
Route::filter('user', function(){

	if(!Sentry::check()){
        Session::flash('error_messages', array(Lang::get('user.login_required')));
		return Redirect::guest('user/login');
	}


	$user = Sentry::getUser();
    $userGroup = Sentry::getGroupProvider()->findByName('Users');
    $adminGroup = Sentry::getGroupProvider()->findByName('Administrator');
  
	if(!($user->inGroup($userGroup) || $user->inGroup($adminGroup))) {
		Session::flash('error_messages', array(Lang::get('user.login_required')));
		return Redirect::guest('user/login');
	}
});

//Check if user has logged, if is logged, redirect to previous page
//the method is maintally used to prevent logged in user to go to login page
Route::filter('loggedUser', function(){
 
	if(Sentry::check()){
	   return Redirect::home();
	}
});