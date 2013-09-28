<?php

class AdminUserController extends BaseController {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = 100;
		$user = User::select('*');
		if (Input::get('onlyBanned') == 'true') {
			$user = $user->join('throttle', 'users.id', '=', 'throttle.user_id');
			$user = $user->where('throttle.banned', '=', Input::get('onlyBanned'));
		}

		if (Input::has('search')) {
			$user = $user->where('username', 'LIKE', Input::get('search'));
			$user = $user->orWhere('email', 'LIKE', Input::get('search'));
		}

		return $user->limit($limit)->orderBy('created_at', 'desc')->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}