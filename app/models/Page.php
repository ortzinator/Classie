<?php

class Page extends Eloquent {

	public static $rules = array(
		'title'			=> 'required|unique:pages',
		'name'			=> 'required|unique:pages',
		'content'		=> 'required'
		);

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;
		$this->attributes['name'] = Str::slug($value);
	}

}