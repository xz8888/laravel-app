<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::get('/', 
	array(
	     'as' => 'home',
		 'uses' => 'HomeController@index'	
	)
);


Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

/**
 * Currently check if user is in the admin group
 */
Route::filter('admin', function(){
	if (!Sentry::check()){
		Session::flash("messages",array(Lang::line('user.invalid_login')));
	    return Redirect::to('user/login');
	}
	
	$user = Sentry::user();
	if(!$user->in_group('admin')){
		Session::flash("messages",array(Lang::line('user.invalid_login')));
		return Redirect::to('user/login');
	}
});

Route::filter('user', function(){
	if(!Sentry::check()){
		Session::flash("messages",array(Lang::line('user.invalid_login')));
		return Redirect::to('user/login');
	}

	$user = Sentry::user();
	if(!$user->in_group('user')) {
		Session::flash("messages",array(Lang::line('user.invalid_login')));
		return Redirect::to('user/login');
	}
	
});
