<?php namespace Ortzinator\Classie\Models;

class Posting extends \LaravelBook\Ardent\Ardent {

	public static $rules = array(
		'title' 		=> 'required|between:5,100',
		'category_id' 	=> 'required|exists:categories,id',
		'area' 			=> 'between:3,30',
		'content' 		=> 'required|between:10,3000',
		'days' 			=> 'integer|between:1,60',
		'user_id'		=> 'required|exists:users,id'
		);

	public $autoPurgeRedundantAttributes = true;

	public $presenter = 'Ortzinator\Classie\Presenters\PostingPresenter';

	function __construct() {
		parent::__construct();
		$this->purgeFilters[] = function ($attributeKey) {
			return $attributeKey != 'days';
		};
	}

	public function getDates()
	{
		return array('created_at', 'expires_at');
	}
	
	public function category()
	{
		return $this->belongsTo('Ortzinator\Classie\Models\Category');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function questions()
	{
		return $this->hasMany('Ortzinator\Classie\Models\Question');
	}

	public function setDaysAttribute($value)
	{
		if(!is_int($value)) return;
		$expires = new \DateTime('now');
		$expires = addDays($expires, $value);

		$this->attributes['expires_at'] = $expires->getTimestamp();
		$this->attributes['days'] = $value;
	}

	public function beforeSave()
	{
		if(!isset($this->attributes['expires_at']))
		{
			$expires = new \DateTime('now');
			$this->attributes['expires_at'] = $expires->add(new \DateInterval('P2W'));
		}
	}

	public function hasExpired()
	{
		$date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->attributes['expires_at']));
		return $date->isPast();
	}

	public function getClosedAttribute($value)
	{
		return $this->hasExpired();
	}

	public function scopeClosed($query)
	{
		return $query->where('expires_at', '<=', \Carbon\Carbon::now());
	}

	public function scopeOpen($query)
	{
		return $query->where('expires_at', '>', \Carbon\Carbon::now());
	}
}