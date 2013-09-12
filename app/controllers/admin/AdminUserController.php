<?php

class AdminUserController extends BaseController {

	public function getIndex()
	{
		return View::make('admin.users.list');
	}

}