<?php

class Category extends Eloquent {
	public $timestamps = false;

	public function postings()
	{
		return $this->hasMany('Posting');
	}
}