<?php

use Ortzinator\Classie\Models\Category;
use Ortzinator\Classie\Models\Page;
use Ortzinator\Classie\Models\Posting;
use Ortzinator\Classie\Models\Question;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CategoriesSeeder');
		$this->call('SentrySeeder');
		$this->call('ProfilesSeeder');
		$this->call('PostingsSeeder');
		$this->call('PagesSeeder');
	}

}

class CategoriesSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array('name' => 'Services'));
		Category::create(array('name' => 'For Sale'));
		Category::create(array('name' => 'Jobs'));
	}

}

class ProfilesSeeder extends Seeder {

	public function run()
	{
		DB::table('profiles')->delete();

		Profile::create(array(
			'user_id' => '1',
			'country' => 'USA',
			'bio' => 'blaaahhh',
			));
	}

}
 
class SentrySeeder extends Seeder {
 
	public function run()
	{
		DB::table('users')->delete();
		DB::table('groups')->delete();
		DB::table('users_groups')->delete();
 
		Sentry::getUserProvider()->create(array(
			'email'       => 'admin@admin.com',
			'password'    => 'admin',
			'first_name'  => 'John',
			'last_name'   => 'McClane',
			'activated'   => 1,
			'username'    => 'JClane',
		));

		Sentry::getUserProvider()->create(array(
			'email'       => 'test1@test.com',
			'password'    => 'test',
			'first_name'  => 'Jerry',
			'last_name'   => 'Seinfeld',
			'activated'   => 1,
			'username'    => 'JFeld',
		));
 
		Sentry::getGroupProvider()->create(array(
			'name'        => 'Admin',
			'permissions' => array('admin' => 1),
		));
 
		// Assign user permissions
		$adminUser  = Sentry::getUserProvider()->findByLogin('admin@admin.com');
		$adminGroup = Sentry::getGroupProvider()->findByName('Admin');
		$adminUser->addGroup($adminGroup);
	}
 
}

class PostingsSeeder extends Seeder {

	public function run()
	{
		DB::table('postings')->delete();

		$in_two_weeks = new DateTime('now');
		$in_two_weeks = $in_two_weeks->add(new DateInterval('P2W'));

		$posting = new Posting;
		$posting->user_id = User::first()->id;
		$posting->content = 'HDTV for sale 32"';
		$posting->expires_at = $in_two_weeks;
		$posting->closed = false;
		$posting->title = 'HDTV 32"';
		$posting->category_id = Category::where('name', '=', 'For Sale')->first()->id;
		$posting->area = 'Springfield';
		$posting->save();

		DB::table('questions')->delete();

		$asker = Sentry::getUserProvider()->findByLogin('test1@test.com');

		$question = Question::create(array(
			'user_id' => $asker->id,
			'parent_id' => '0',
			'posting_id' => $posting->id,
			'content' => 'How big is it?'
			));

		$answer = Question::create(array(
			'user_id' => $posting->user_id,
			'parent_id' => $question->id,
			'posting_id' => $posting->id,
			'content' => 'It\'s REALLY BIG DUDE'
			));
	}

}

/**
* 
*/
class PagesSeeder extends Seeder
{
	
	function run()
	{
		DB::table('pages')->delete();

		Page::create(array(
			'title' => 'About',
			'name' => 'about',
			'content' => '## Classie

Open source classified ad software written in PHP.

### Requirements

* PHP >= 5.3.7
* MCrypt PHP Extension
* [Composer](http://getcomposer.org/)

### Installing

These instructions are for a **development** install only. The project is **not** ready for a production environment.

    >composer install
    >php artisan migrate --package=cartalyst/sentry
    >php artisan migrate
    >php artisan db:seed
    >php artisan serve

### License

Classie is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)'
			));
	}
}
