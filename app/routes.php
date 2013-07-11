<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'PagesController@latest'));
Route::get('c/{id}', array('as' => 'posting', 'uses' => 'PostingController@posting'));
Route::get('post', array('as' => 'newPost', 'uses' => 'PostingController@newPost'));
Route::get('u/{id}', array('as' => 'userProfile', 'uses' => 'PagesController@profile'));
Route::get('category/{id}/{name?}', 
	array('as' => 'category', 'uses' => 'PagesController@category'))->where('id', '[0-9]+');

//Route::post('login', array('as' => 'login', 'uses' => 'AuthController@login'));
//Route::get('login', array('as' => 'login', 'uses' => 'AuthController@login'));

Route::controller('auth', 'AuthController');

Route::get('users', array('as' => 'users', function()
{
	$users = User::all();

	return View::make('users')->with('users', $users);
}));

