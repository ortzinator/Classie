<?php namespace Ortzinator\Classie\Models;

class Question extends \LaravelBook\Ardent\Ardent {

	public static $rules = array(
		'content' 		=> 'required|between:5,500',
		'posting_id' 	=> 'required|exists:postings,id',
		'parent_id'		=> 'exists:questions,id'
		);

	public $presenter = 'Ortzinator\Classie\Presenters\QuestionPresenter';

	protected $with = array('children');

	public function parent()
	{
		return $this->belongsTo('Ortzinator\Classie\Models\Question', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('Ortzinator\Classie\Models\Question', 'parent_id');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function isTopLevel()
	{
		return $this->attributes['parent_id'] == NULL;
	}
}