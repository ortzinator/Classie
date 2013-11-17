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

		$this->beforeFilter('auth', ['only' => ['create', 'store']]);
	}

	public function index()
	{
		if (Input::has('query')) {
			return View::make('searchResults')->withResults($this->posting->search(Input::get('query')));
		}
		return View::make('postings')->withPostings($this->posting->paginate());
	}

	public function show($id)
	{
		$data = array();
		$data['fied'] = $this->posting->find($id);
		
		$data['poster'] = $data['fied']->user;
		$data['user_is_poster'] = Sentry::check() && $data['poster']->id == Sentry::getUser()->id;

		return View::make('posting')->with($data);
	}

	public function create()
	{
		return View::make('newPosting')
			->with(['categoryList' => $this->category->lists('name', 'id')]);
	}

	public function store()
	{
		$data = Input::all();
		$data['closed']			= false;
		$data['user_id']		= Sentry::getUser()->id;

		$posting = $this->posting->newInstance($data);

		if ($posting->save()) {
			return Redirect::route('posting.show', [$posting->id]);
		}
		else {
			return Redirect::route('posting.create')->withErrors($posting->errors())
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

}