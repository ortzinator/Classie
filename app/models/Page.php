<?php namespace Ortzinator\Classie\Models;

class Page extends \Illuminate\Database\Eloquent\Model {

	public static $rules = array(
		'title'			=> 'required|unique:pages',
		'name'			=> 'required|unique:pages',
		'content'		=> 'required'
		);

	public function setTitleAttribute($value)
	{
		$this->attributes['title'] = $value;
		$this->attributes['name'] = \Str::slug($value);
	}

}