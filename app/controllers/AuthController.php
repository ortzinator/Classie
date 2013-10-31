<?php

class AuthController extends BaseController {

	public function postLogin()
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

			$user = Sentry::authenticate($credentials, false);
			Session::flash('alert-success', 'You were successfully logged in.');
			return Redirect::intended('/');
		}
		catch (Exception $e)
		{
			Session::flash('alert-error', 'An error occured');
			return Redirect::to('auth/login');
		}
	}

	public function getLogin()
	{
		$data = array();
		return View::make('login')->with($data);
	}

	public function getLogout()
	{
		Sentry::logout();
		Session::flash('alert-success', 'You were successfully logged out.');
		return Redirect::to('/');
	}

	public function getRegister()
	{
		return View::make('auth.register');
	}

	public function postRegister()
	{
		try
		{
			$rules = array(
				'email'				=> 'required|email',
				'username'			=> 'required|regex:/^\D.+/|between:2,20',
				'password'			=> 'required|confirmed|min:5',
			);

			$validator = Validator::make(Input::all(), $rules);
			
			if($validator->passes())
			{
				$user = Sentry::register([
					'email'		=> Input::get('email'),
					'password'	=> Input::get('password'),
					'username'	=> Input::get('username')
				], true);

				//$activationCode = $user->getActivationCode();

				//TODO: Email activation code
				Sentry::login($user, false);
				return Redirect::to('auth/done')->with(['email' => Input::get('email')]);
			}
			else
			{
				return Redirect::to('auth/register')->withErrors($validator)->withInput(Input::all());
			}
		}
		catch (Exception $e)
		{
			Session::flash('alert-error', 'An error occured');
			return Redirect::to('auth/register');
		}
	}

	public function getActivate($value)
	{
		return "code: " . $value;
	}

	public function getDone()
	{
		return View::make('auth.activationInstructions', ['email' => Session::get('email')]);
	}
}