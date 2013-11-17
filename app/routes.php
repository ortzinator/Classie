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

// Aliases
Route::get('login', 'AuthController@create');
Route::get('logout', 'AuthController@destroy');
Route::get('register', 'UserController@create');

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@latest']);
//Route::get('c/{id}', ['as' => 'posting', 'uses' => 'PostingController@posting']);
Route::get('u/{id}', ['as' => 'userProfile', 'uses' => 'PagesController@profile']);
Route::get('search/{input?}', ['as' => 'search', 'uses' => 'PagesController@search']);
Route::post('search', ['as' => 'searchForm', 'uses' => 'PagesController@searchForm']);

// Resources
Route::resource('postings', 'PostingController');
Route::resource('auth', 'AuthController', ['only' => ['create', 'destroy', 'store']]);
Route::resource('users', 'UserController', ['except' => ['index']]);

Route::get('categories/{id}/{name?}', 
	['as' => 'category', 'uses' => 'CategoriesController@show'])->where('id', '[0-9]+');
Route::get('categories', ['as' => 'categoryListing', 'uses' => 'CategoriesController@index']);

Route::group(array('before' => 'auth'), function()
{
	Route::post('do_question', ['as' => 'doQuestion', 'uses' => 'PostingController@doQuestion',
		'before' => 'auth']);
	Route::get('settings', ['as' => 'settings', 'uses' => 'PagesController@userSettings',
		'before' => 'auth']);
	Route::post('saveSettings', ['as' => 'saveSettings', 'uses' => 'PagesController@saveSettings',
		'before' => 'auth']);
});


Route::group(array('before' => 'admin'), function()
{
	Route::resource('api/users', 'AdminUserController');
	Route::resource('api/settings', 'AdminSettingsController');
});

Route::get('pages/{page}', 'PagesController@cms');

