<?php

use Ortzinator\Classie\Repositories\PostingRepository;
use Ortzinator\Classie\Repositories\CategoryRepository;

class PostingController extends Controller {

	protected $posting;
	protected $category;

	function __construct(PostingRepository $posting, CategoryRepository $category)
	{
		$this->posting = $posting;
		$this->category = $category;
	}

	public function posting($id)
	{
		$data = array();
		$data['fied'] = $this->posting->find($id);
		if ($data['fied']->hasExpired())
		{
			$data['fied']->closed = true;
			$data['fied']->save();
			//return Redirect::home();
		}
		$data['poster'] = $data['fied']->user()->first();
		$data['user_is_poster'] = Sentry::check() && $data['poster']->id == Sentry::getUser()->id;
		$data['questions'] = Question::where('posting_id', '=', $id)
			->where('parent_id', '=', 0)->orWhere('parent_id')->get();

		return View::make('posting')->with($data);
	}

	public function newPosting()
	{
		return View::make('newPosting')
			->with(['categoryList' => $this->category->lists('name', 'id')]);
	}

	public function doPost()
	{
		$data = Input::all();
		$data['closed']			= false;
		$data['user_id']		= Sentry::getUser()->id;

		$posting = $this->posting->newInstance($data);

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
		$posting = $this->posting->find(Input::get('posting'));
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