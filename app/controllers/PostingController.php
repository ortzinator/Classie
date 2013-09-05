<?php

class PostingController extends Controller {

	public function posting($id)
	{
		$data = array();
		$data['fied'] = Posting::findOrFail($id);
		$data['poster'] = $data['fied']->user()->first();
		$data['user_is_poster'] = Sentry::check() && $data['poster']->id == Sentry::getUser()->id;
		$data['$questions'] = Question::where('posting_id', '=', $id)
			->where('parent_id', '=', 0)->orWhere('parent_id')->get();

		return View::make('posting')->with($data);
	}

	public function newPosting()
	{
		return View::make('newPosting');
	}

	public function doPost()
	{
		$posting = new Posting;
		$posting->title			= Input::get('title');
		$posting->category_id	= Input::get('category');
		$posting->area			= Input::get('area');
		$posting->content		= Input::get('detail');
		$posting->days			= Input::get('days');
		$posting->closed		= false;
		$posting->user_id		= Sentry::getUser()->id;

		if ($posting->save()) {
			return Redirect::route('posting', [$posting->id]);
		}
		else {
			return Redirect::route('newPost')->withErrors($posting->errors())
				->withInput(Input::all());
		}
	}

	public function doQuestion()
	{
		$posting = Posting::findOrFail(Input::get('posting'));
		$poster = $posting->user()->first();
		$user_is_poster = Sentry::check() && $data['poster']->id == Sentry::getUser()->id;

		if ($user_is_poster) {
			return Redirect::route('posting', Input::get('posting'));
		}

		$question = new Question;
		$question->content = Input::get('content');
		$question->posting_id = Input::get('posting');
		$question->user_id = Sentry::getUser()->id;
		$question->parent_id = 0;

		if ($question->save()) {
			return Redirect::route('posting', [Input::get('posting')]);
		}
		else {
			return Redirect::route('posting', [Input::get('posting')])
				->withErrors($question->errors())->withInput(Input::all());
		}
	}

}