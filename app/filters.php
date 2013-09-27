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
	if(!starts_with($request->path(), 'auth')) Session::flash('redirect', $request->path());
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

Route::filter('auth', function($route, $request)
{
	if (!Sentry::check()){
		return Redirect::to('auth/login');
	}
});

Route::filter('admin', function($route, $request)
{
	$admin_group = Sentry::getGroupProvider()->findByName('Admin');
	if(!Sentry::check() || !Sentry::getUser()->inGroup($admin_group)) {
		return Redirect::to('auth/login');
	}
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
	if (Sentry::check()) return Redirect::to('/');
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

View::composer(array('layout', 'admin.layout', 'admin.index'), function($view)
{
	$pages = App::make('Ortzinator\Classie\Repositories\PagesRepository');
	$category = App::make('Ortzinator\Classie\Repositories\CategoryRepository');

	$admin = Sentry::getGroupProvider()->findByName('Admin');

	$view->with('is_admin', Sentry::check() && Sentry::getUser()->inGroup($admin));
	$view->with('categories', $category->all());
	$view->with('pages', $pages->all(['id', 'name']));

});