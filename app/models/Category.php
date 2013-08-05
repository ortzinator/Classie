<?php

class Category extends \LaravelBook\Ardent\Ardent {
	
	public $timestamps = false;

	public static $rules = array(
		'name'			=> 'required|unique:categories',
		'short_name'	=> 'required|unique:categories',
		'parent_id'		=> 'exists:categories,id',
		);

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

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = $value;
		$this->attributes['short_name'] = Str::slug($value);
	}
}