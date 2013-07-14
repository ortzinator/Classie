<?php

class PostingController extends Controller {

	public function posting($id)
	{
		$posting = Posting::findOrFail($id);
		//dd(User::find(1));
		return View::make('posting')->with('fied', $posting);
	}

	public function newPost()
	{
		return View::make('newPost');
	}

}