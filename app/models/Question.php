<?php

class Question extends Eloquent {
	public function parent()
	{
		return $this->belongsTo('Question', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('Question', 'parent_id');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}