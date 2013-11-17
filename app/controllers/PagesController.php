<?php

use Ortzinator\Classie\Repositories\PostingRepository;
use Ortzinator\Classie\Repositories\PagesRepository;

class PagesController extends BaseController {

	protected $posting;
	protected $pages;

	function __construct(PostingRepository $posting, PagesRepository $pages)
		$this->posting = $posting;
		$this->pages = $pages;
	}

	public function latest()
	{
		return View::make('latest')->withPostings($this->posting->paginate());
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