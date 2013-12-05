<?php

class SentrySeeder extends Seeder {
 
	public function run()
	{
		DB::table('users')->delete();
		DB::table('groups')->delete();
		DB::table('users_groups')->delete();
		DB::table('throttle')->delete();
 
		$adminUser = Sentry::getUserProvider()->create(array(
			'email'			=> 'admin@admin.com',
			'password'		=> 'admin',
			'first_name'	=> 'John',
			'last_name'		=> 'McClane',
			'activated'		=> 1,
			'username'		=> 'JClane',
			'permissions'	=> ['superuser' => 1]
		));

		Sentry::getUserProvider()->create(array(
			'email'			=> 'test1@test.com',
			'password'		=> 'test',
			'first_name'	=> 'Jerry',
			'last_name'		=> 'Seinfeld',
			'activated'		=> 1,
			'username'		=> 'JFeld',
		));
 
		Sentry::getGroupProvider()->create(array(
			'name'			=> 'Admin',
			'permissions'	=> array('admin' => 1),
		));
 
		// Assign user permissions
		$adminGroup = Sentry::getGroupProvider()->findByName('Admin');
		$adminUser->addGroup($adminGroup);

		//Create a banned user
		$troll = Sentry::getUserProvider()->create(array(
			'email'			=> 'ban@ban.com',
			'password'		=> 'test',
			'first_name'	=> 'Troll',
			'last_name'		=> 'McTroller',
			'activated'		=> 1,
			'username'		=> 'Bann',
		));

		$throttle = Sentry::findThrottlerByUserId($troll->id);
		$throttle->ban();
	}
 
}