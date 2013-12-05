<?php

use Ortzinator\Classie\Models\Page;

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