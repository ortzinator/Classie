<?php

class ProfilesSeeder extends Seeder {

	public function run()
	{
		DB::table('profiles')->delete();

		Profile::create(array(
			'user_id' => '1',
			'location' => 'USA',
			'bio' => 'blaaahhh',
			));
	}

}