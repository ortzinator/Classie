<?php

class QuestionsController extends BaseController {

	function __construct() {
		$this->beforeFilter('auth', ['only' => ['store']]);
		$this->beforeFilter('admin', ['only' => ['destroy']]); //Also question's owner?
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$posting = $this->posting->find(Input::get('posting'));
		$poster = $posting->user()->first();
		$user_is_poster = Sentry::check() && $poster->id == Sentry::getUser()->id;

		if ($user_is_poster) {
			return Redirect::route('posting', Input::get('posting'));
		}

		$data = Input::all();
		$data['user_id'] = Sentry::getUser()->id;
		$data['parent_id'] = NULL;
		$question = $this->question->newInstance($data);

		if ($question->save()) {
			return Redirect::route('posting', [Input::get('posting')]);
		}
		else {
			return Redirect::route('posting', [Input::get('posting')])
				->withErrors($question->errors())->withInput(Input::all());
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
		return View::make('questions.show');
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
