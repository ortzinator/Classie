<?php

use Ortzinator\Classie\Repositories\PostingRepository;

class PagesController extends BaseController {

	protected $posting;

	function __construct(PostingRepository $posting) {
		$this->posting = $posting;
	}

	public function latest()
	{
		return View::make('latest')->with('recent', $this->posting->getLatest());
	}

	public function profile($id)
	{
		$posts = $this->posting->postsByUser($id);
		$data = array('posts' => $posts, 'user' => User::findOrFail($id));
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

	public function search($query = '')
	{
		$result = $this->posting->search($query);
		return View::make('searchResults', ['results' => $result, 'query' => $query]);;
	}

	public function searchForm()
	{
		return Redirect::route('search', [Input::get('query')]);
	}

	public function userSettings()
	{
		$user = Sentry::getUser();
		return View::make('user.settings')->with('user', $user);
	}

	public function saveSettings()
	{
		$user = Sentry::getUser();
		$user->name = Input::get('name');
		
		if($user->save()) {
			Session::flash('alert-success', 'Settings saved');
			return Redirect::route('settings');
		}
		else {
			return Redirect::route('settings')->withErrors($user->validationErrors)
				->withInput(Input::all());
		}
	}

}