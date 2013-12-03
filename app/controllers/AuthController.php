<?php

class AuthController extends BaseController {

	public function store()
	{
		$validator = Validator::make(Input::all(), [
			'email' => 'required|email',
			'password' => 'required'
			]
		);

		if ($validator->fails())
		{
			return Redirect::to('auth/login')->withErrors($validator);
		}
		
		try
		{
			$credentials = array(
				'email'    => Input::get('email'),
				'password' => Input::get('password'),
			);

			Sentry::authenticate($credentials, !!Input::get('remember'));
			Session::flash('alert-success', 'You were successfully logged in.');
			return Redirect::intended('/');
		}
		catch (Exception $e)
		{
			Session::flash('alert-error', 'The provided email and/or password was incorrect.');
			return Redirect::to('auth/login');
		}
	}

	public function create()
	{
		$data = array();
		return View::make('login')->with($data);
	}

	public function destroy()
	{
		Sentry::logout();
		Session::flash('alert-success', 'You were successfully logged out.');
		return Redirect::to('/');
	}
}