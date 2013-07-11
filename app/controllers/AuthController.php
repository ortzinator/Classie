<?php

use Cartalyst\Sentry\Users;

class AuthController extends BaseController {

	public function postLogin()
	{
		$validator = Validator::make(Input::all(),
			array('email' => 'required',
				'password' => 'required')
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
			return Redirect::to('/');
		}
		catch (LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch (PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch (WrongPasswordException $e)
		{
			echo 'Wrong password, try again.';
		}
		catch (UserNotFoundException $e)
		{
			echo 'User was not found.';
		}
		catch (UserNotActivatedException $e)
		{
			echo 'User is not activated.';
		}
	}

	public function getLogin()
	{
		$data = array();
		return View::make('login')->with($data);
	}
}