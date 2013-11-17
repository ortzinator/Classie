<?php

use Ortzinator\Classie\Repositories\PostingRepository;

class UserController extends BaseController {

	protected $posting;

	function __construct(PostingRepository $posting)
	{
		$this->posting = $posting;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
			$rules = array(
				'email'				=> 'required|email',
				'username'			=> 'required|between:2,20|regex:/^\D.+/',
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
				//return Redirect::to('auth/done')->with(['email' => Input::get('email')]);
				return Redirect::home();
			}
			else
			{
				// dd('wut');
				return Redirect::route('users.create')->withErrors($validator)->withInput(Input::all());
			}
		}
		catch (Exception $e)
		{
			Session::flash('alert-error', 'An error occured');
			return Redirect::route('users.create');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$posts = $this->posting->postsByUser($id);
		$data = array('posts' => $posts, 'user' => Sentry::findUserById($id));
		return View::make('profile')->with($data);
	}
}
