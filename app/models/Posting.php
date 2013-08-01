<?php

class Posting extends \LaravelBook\Ardent\Ardent {

	protected $guarded = array('id');

	public static $rules = array(
		'title' 		=> 'required',
		'category_id' 	=> 'required',
		'area' 			=> 'max:30',
		'content' 		=> 'required|min:10|max:3000',
		'days' 			=> 'required|integer|between:1,60'
		);

	public $autoPurgeRedundantAttributes = true;

	function __construct() {
		parent::__construct();
		$this->purgeFilters[] = function ($attributeKey) {
			if ($attributeKey == 'days')
			{
				return false;
			}

			return true;
		};
	}

	public function getDates()
	{
		return array('created_at', 'expires_at');
	}
	
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

	public function setDaysAttribute($value)
	{
		$expires = new DateTime('now');
		$expires = $expires->add(DateInterval::createFromDateString($value . ' days'));

		$this->attributes['expires_at'] = $expires;
		$this->attributes['days'] = $value;
	}

	public function beforeSave()
	{
		if($this->attributes['expires_at'] == NULL)
		{
			$expires = new DateTime('now');
			dd($expires);
			$this->attributes['expires_at'] = $expires->add(new DateInterval('P2W'));
		}
	}
}