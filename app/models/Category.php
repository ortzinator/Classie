<?php

class Category extends Eloquent {
	public $timestamps = false;

	public function postings()
	{
		return $this->hasMany('Posting');
	}

	public function parent()
	{
		return $this->belongsTo('Category', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany('Category', 'parent_id');
	}
}