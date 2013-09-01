<?php

class PagesController extends BaseController {

	public function latest()
	{
		return View::make('latest')->with('recent', Posting::orderBy('created_at', 'desc')->get());
	}

	public function profile($id)
	{
		$data = array('posts' => Posting::where('user_id', $id)->get(), 'user' => User::find($id));
		return View::make('profile')->with($data);
	}

	public function category($id, $name = '')
	{
		return View::make('category')->with('category', Category::find($id));
	}

	public function categories()
	{
		$query = Category::where('parent_id', '=', 0)->orWhere('parent_id');
		return View::make('categories')->with('categories', 
			$query->get());
	}

	public function cms($name)
	{
		$page = Page::where('name', $name)->first();
		return View::make('page')->with('page', $page);
	}

	public function search($input = '')
	{
		$query = Posting::where('title', 'LIKE', $input);
		return View::make('searchResults', ['results' => $query->get(), 'query' => $input]);;
	}

	public function searchForm()
	{
		return Redirect::route('search', [Input::get('query')]);
	}

}