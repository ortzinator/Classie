<?php

class PostingController extends Controller {

	public function posting($id)
	{
		$posting = Posting::findOrFail($id);
		$questions = Question::where('posting_id', '=', $id)
			->where('parent_id', '=', 0)->orWhere('parent_id')->get();
		return View::make('posting')->with(array('fied' => $posting, 'questions' => $questions));
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
			return Redirect::route('posting', array($posting->id));
		}
		else {
			return Redirect::route('newPost')->withErrors($posting->errors())
				->withInput(Input::all());
		}
	}

	public function doQuestion()
	{
		$question = new Question;
		$question->content = Input::get('content');
		$question->posting_id = Input::get('posting');
		$question->user_id = Sentry::getUser()->id;
		$question->parent_id = 0;

		if ($question->save()) {
			return Redirect::route('posting', array(Input::get('posting')));
		}
		else {
			return Redirect::route('posting', array(Input::get('posting')))
				->withErrors($question->errors())->withInput(Input::all());
		}
	}

}