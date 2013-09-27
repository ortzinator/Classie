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
Route::get('search/{input?}', ['as' => 'search', 'uses' => 'PagesController@search']);
Route::post('search', ['as' => 'searchForm', 'uses' => 'PagesController@searchForm']);

Route::get('categories/{id}/{name?}', 
	['as' => 'category', 'uses' => 'CategoriesController@show'])->where('id', '[0-9]+');
Route::get('categories', ['as' => 'categoryListing', 'uses' => 'CategoriesController@index']);

Route::group(array('before' => 'auth'), function()
{
	Route::get('post', ['as' => 'newPost', 'uses' => 'PostingController@newPosting',
		'before' => 'auth']);
	Route::post('do_post', ['as' => 'doPost', 'uses' => 'PostingController@doPost',
		'before' => 'auth']);
	Route::post('do_question', ['as' => 'doQuestion', 'uses' => 'PostingController@doQuestion',
		'before' => 'auth']);
	Route::get('settings', ['as' => 'settings', 'uses' => 'PagesController@userSettings',
		'before' => 'auth']);
	Route::post('saveSettings', ['as' => 'saveSettings', 'uses' => 'PagesController@saveSettings',
		'before' => 'auth']);
});

Route::controller('auth', 'AuthController');

Route::group(array('before' => 'admin'), function()
{
	Route::resource('api/users', 'AdminUserController');
	Route::get('admint{slug}', 'AdminController@index')->where('slug', '([A-z\d-\/_.]+)?');
});

Route::get('pages/{page}', 'PagesController@cms');

Route::get('users', ['as' => 'users', function()
{
	$users = User::all();
	return View::make('users')->with('users', $users);
}]);

