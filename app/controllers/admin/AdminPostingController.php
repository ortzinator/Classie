<?php

class AdminPostingController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.postings.list');
	}

}