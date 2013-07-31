<?php

use Cartalyst\Sentry\Users;

class AuthController extends BaseController {

	public function postLogin()
	{
		$validator = Validator::make(Input::all(),
			array('email' => 'required',
				'password' => 'required'
				)
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

			$user = Sentry::authenticate($credentials, false);
			Session::flash('alert-success', 'You were successfully logged in.');
			return Redirect::to(Session::get('redirect', '/'));
		}
		catch (LoginRequiredException $e)
		{
			return Redirect::to('auth/login')->withErrors($e);
		}
		catch (PasswordRequiredException $e)
		{
			return Redirect::to('auth/login')->withErrors($e);
		}
		catch (WrongPasswordException $e)
		{
			return Redirect::to('auth/login')->withErrors($e);
		}
		catch (UserNotFoundException $e)
		{
			return Redirect::to('auth/login')->withErrors($e);
		}
		catch (UserNotActivatedException $e)
		{
			return Redirect::to('auth/login')->withErrors($e);
		}
	}

	public function getLogin()
	{
		$data = array();
		Session::keep('redirect');
		return View::make('login')->with($data);
	}

	public function getLogout()
	{
		Sentry::logout();
		Session::flash('alert-success', 'You were successfully logged out.');
		return Redirect::to(Session::get('redirect', '/'));
	}
}