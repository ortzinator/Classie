<?php

class PostingController extends Controller {

	public function posting($id)
	{
		$posting = Posting::findOrFail($id);
		return View::make('posting')->with('fied', $posting);
	}

	public function newPosting()
	{
		return View::make('newPosting');
	}

	public function doPost()
	{
		//
	}

}