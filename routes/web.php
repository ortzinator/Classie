<?php

use Classie\Http\Controllers\FileUploadController;
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

Route::post('/upload', [FileUploadController::class, 'store']);