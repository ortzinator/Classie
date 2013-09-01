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

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@latest']);
Route::get('c/{id}', ['as' => 'posting', 'uses' => 'PostingController@posting']);
Route::get('u/{id}', ['as' => 'userProfile', 'uses' => 'PagesController@profile']);

Route::get('category/{id}/{name?}', 
	['as' => 'category', 'uses' => 'PagesController@category'])->where('id', '[0-9]+');
Route::get('categories', ['as' => 'categoryListing', 'uses' => 'PagesController@categories']);

Route::get('post', ['as' => 'newPost', 'uses' => 'PostingController@newPosting',
	'before' => 'auth']);
Route::post('do_post', ['as' => 'doPost', 'uses' => 'PostingController@doPost',
	'before' => 'auth']);
Route::post('do_question', ['as' => 'doQuestion', 'uses' => 'PostingController@doQuestion',
	'before' => 'auth']);

Route::controller('auth', 'AuthController');

Route::get('pages/{page}', 'PagesController@cms');

Route::get('users', ['as' => 'users', function()
{
	$users = User::all();

	return View::make('users')->with('users', $users);
}]);

