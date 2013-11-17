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

// Aliases
Route::get('login', 'AuthController@create');
Route::get('logout', 'AuthController@destroy');
Route::get('register', 'UserController@create');

// Resources
Route::resource('postings', 'PostingController');
Route::resource('auth', 'AuthController', ['only' => ['create', 'destroy', 'store']]);
Route::resource('users', 'UserController', ['only' => ['create', 'store', 'show']]);

Route::get('categories/{id}/{name?}', 
	['as' => 'category', 'uses' => 'CategoriesController@show'])->where('id', '[0-9]+');
Route::get('categories', ['as' => 'categoryListing', 'uses' => 'CategoriesController@index']);

Route::group(array('before' => 'auth'), function()
{
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

