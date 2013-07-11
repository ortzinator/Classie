<?php

class PagesController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function latest()
	{
		return View::make('latest')->with('recent', Posting::all());
	}

	public function profile($id)
	{
		$data = array('posts' => Posting::where('user_id', $id)->get(), 'user' => User::find($id));
		return View::make('profile')->with($data);
	}

	public function category($id, $name = '')
	{
		return View::make('category')->with(array('category' => Category::find($id)));
	}

}