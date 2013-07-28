<?php

class PostingController extends Controller {

	public function posting($id)
	{
		$posting = Posting::findOrFail($id);
		$questions = Question::where('posting_id', '=', $id)->where('parent_id', '=', 0)->get();
		return View::make('posting')->with(array('fied' => $posting, 'questions' => $questions));
	}

	public function newPosting()
	{
		return View::make('newPosting');
	}

	public function doPost()
	{
		$validator = Validator::make(Input::all(),
			array(
				'title' 	=> 'required',
				'category' 	=> 'required',
				'area' 		=> 'max:30',
				'detail' 	=> 'required|min:10|max:3000',
				'days' 		=> 'integer|between:1,60'
				)
		);

		if ($validator->fails())
		{
			return Redirect::route('newPost')->withErrors($validator)->withInput(Input::all());
		}
		else
		{
			if(Input::has('days'))
			{
				$expires = new DateTime('now');
				$expires = $expires->add(DateInterval::createFromDateString(Item::get('days') . ' days'));
			}
			else
			{
				$expires = new DateTime('now');
				$expires = $expires->add(new DateInterval('P2W'));
			}

			$posting = Posting::create(array(
				'title' 		=> Input::get('title'),
				'category_id' 	=> Input::get('category'),
				'area' 			=> Input::get('area'),
				'content' 		=> Input::get('detail'),
				'expires_at'	=> $expires,
				'closed'		=> false,
				'user_id'		=> Sentry::getUser()->id,
			));

			return Redirect::route('posting', array($posting->id));
		}
	}

}