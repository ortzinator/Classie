<?php

class Posting extends Eloquent {

	protected $guarded = array('id');
	
	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function questions()
	{
		return $this->hasMany('Question');
	}
}