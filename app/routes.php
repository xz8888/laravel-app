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

Route::get('message', array('uses' => 'HomeController@message'));


/************** Router for questions begin ************/
Route::resource('question', 'QuestionController', array('only' => array('index', 'show')));
Route::get('question-create', array('uses' => 'QuestionController@create', 'before' => 'user'));
Route::post('question-store', array('uses' => 'QuestionController@store', 'before' => 'user|csrf'));
Route::post('question-reply', array('uses' => 'QuestionController@reply', 'before' => 'user|csrf'));
/************** Router for questions end *************/

/************** User Route *************/
Route::any('user/login', array('uses' => 'UserController@login', 'before' => 'loggedUser'));
Route::any('user/register', array('uses' => 'UserController@register'));
Route::any('user/logout', array('uses' => 'UserController@logout'));
Route::any('user/activation', array('uses' => 'UserController@activate'));
Route::get('share', array('uses' => 'ApplicationController@share', 'before' => 'user'));
Route::post('share', array('uses' => 'ApplicationController@share', 'before' => 'user|csrf'));
Route::any('my', array('uses' => 'UserController@show', 'before' => 'user'));
/************** End User Route *********/

/************** Application ***********/
Route::any('applications', array('uses' => 'ApplicationController@index'));

Route::get('test', function(){
    return View::make('home.hello');
	}
);
