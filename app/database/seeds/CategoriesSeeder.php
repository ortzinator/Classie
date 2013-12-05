<?php

use Ortzinator\Classie\Models\Category;

class CategoriesSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array('name' => 'Services'));
		$forSale = Category::create(array('name' => 'For Sale'));
		Category::create(array('name' => 'Jobs'));

		Category::create(['name' => 'Automotive', 'parent_id' => $forSale->id]);
	}

}