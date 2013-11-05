<?php

class User extends \Cartalyst\Sentry\Users\Eloquent\User {
	
	public function isAdmin(\Cartalyst\Sentry\Groups\Eloquent\Group $group = null)
	{
		if($group == null) { $group = Sentry::getGroupProvider()->findByName('Admin'); }
		return $this->hasAccess('admin') || $this->inGroup($group);
	}
}