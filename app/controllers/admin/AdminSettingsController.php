<?php

class AdminSettingsController extends BaseController {

	public function getIndex()
	{
		//return Redirect::action('AdminSettingsController@getSite');
	}

	public function getSite()
	{
		$data = array();

		if (Setting::has('classie'))
		{
			$data['settings'] = Setting::get('classie');
		}
		else
		{
			$data['settings'] = array();
		}

		return View::make('admin.settings.site', $data);
	}

	public function postSite()
	{
		$settings = array();
		$settings['site_title'] = Input::get('site_title');
		$settings['site_description_long'] = Input::get('site_description_long');
		$settings['site_description_short'] = Input::get('site_description_short');

		Setting::set('classie', $settings);

		return Redirect::action('AdminSettingsController@getSite')
			->with(['settings' => Setting::get('classie')]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Setting::get('classie');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	// public function create()
	// {
	// 	//
	// }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	// public function store()
	// {
	// 	//
	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->index();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function edit($id)
	// {
	// 	//
	// }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(),
			['site_title' => 'required',
			'site_description_long' => 'required',
			'site_description_short' => 'required']
		);

		if ($validator->fails()) {
			$response = array('message' => 'Validation failed');
			return Response::Json($response, 400);
		} else {
			$settings = array();
			$settings['site_title'] = Input::get('site_title');
			$settings['site_description_long'] = Input::get('site_description_long');
			$settings['site_description_short'] = Input::get('site_description_short');

			Setting::set('classie', $settings);

			$response = array('message' => 'Success');
			return Response::Json($response, 200);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function destroy($id)
	// {
	// 	//
	// }

}