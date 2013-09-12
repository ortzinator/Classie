<?php

class AdminSettingsController extends BaseController {

	public function getIndex()
	{
		return Redirect::action('AdminSettingsController@getSite');
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

}