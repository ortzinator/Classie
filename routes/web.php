<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Classie\Http\Controllers\HomeController;
use Classie\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/posts');
});

Route::resource('/posts', PostsController::class);

Route::group(['namespace' => 'Classie\Http\Controllers'], function () {
    Auth::routes();
});

Route::get('/home', [HomeController::class, 'index']);
