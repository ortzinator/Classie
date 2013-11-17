<?php

use Ortzinator\Classie\Repositories\PostingRepository;
use Ortzinator\Classie\Repositories\PagesRepository;
use Ortzinator\Classie\Repositories\CategoryRepository;

class PagesController extends BaseController {

	protected $posting;
	protected $pages;
	protected $category;

	function __construct(PostingRepository $posting, PagesRepository $pages, 
			CategoryRepository $category)
	{
		$this->posting = $posting;
		$this->pages = $pages;
		$this->category = $category;
	}

	public function latest()
	{
		return View::make('latest')->withPostings($this->posting->paginate());
	}

	public function profile($id)
	{
		$posts = $this->posting->postsByUser($id);
		$data = array('posts' => $posts, 'user' => Sentry::findUserById($id));
		return View::make('profile')->with($data);
	}

	public function cms($name)
	{
		$page = $this->pages->findByName($name);
		return View::make('page')->with('page', $page);
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