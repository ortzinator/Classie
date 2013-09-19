<?php

use Ortzinator\Classie\Repositories\PostingRepository;
use Ortzinator\Classie\Repositories\CategoryRepository;
use Ortzinator\Classie\Repositories\QuestionRepository;

class PostingController extends Controller {

	protected $posting;
	protected $category;
	protected $question;

	function __construct(PostingRepository $posting, CategoryRepository $category,
			QuestionRepository $question)
	{
		$this->posting = $posting;
		$this->category = $category;
		$this->question = $question;
	}

	public function posting($id)
	{
		$data = array();
		$data['fied'] = $this->posting->find($id);
		
		$data['poster'] = $data['fied']->user()->first();
		$data['user_is_poster'] = Sentry::check() && $data['poster']->id == Sentry::getUser()->id;
		$data['questions'] = $this->question->findByPosting($id);

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
		$user_is_poster = Sentry::check() && $poster->id == Sentry::getUser()->id;

		if ($user_is_poster) {
			return Redirect::route('posting', Input::get('posting'));
		}

		$data = Input::all();
		$data['user_id'] = Sentry::getUser()->id;
		$data['parent_id'] = 0;
		$question = $this->question->newInstance($data);

		if ($question->save()) {
			return Redirect::route('posting', [Input::get('posting')]);
		}
		else {
			return Redirect::route('posting', [Input::get('posting')])
				->withErrors($question->errors())->withInput(Input::all());
		}
	}

}