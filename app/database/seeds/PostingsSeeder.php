<?php

use Ortzinator\Classie\Models\Category;
use Ortzinator\Classie\Models\Posting;
use Ortzinator\Classie\Models\Question;

class PostingsSeeder extends Seeder {

	public function run()
	{
		DB::table('postings')->delete();
		
		$faker = \Faker\Factory::create();

		$firstUser = User::first();

		$in_two_weeks = \Carbon\Carbon::now()->addDays(14)->timestamp;

		$for_sale = Category::where('name', '=', 'For Sale')->first()->id;
		$auto = Category::where('name', '=', 'Automotive')->first()->id;

		$posting = new Posting;
		$posting->user_id = $firstUser->id;
		$posting->content = 'HDTV for sale 32"';
		$posting->expires_at = $in_two_weeks;
		$posting->closed = false;
		$posting->title = 'HDTV 32"';
		$posting->category_id = $for_sale;
		$posting->area = 'Springfield';
		$posting->save();

		$posting = new Posting;
		$posting->user_id = $firstUser->id;
		$posting->content = 'Toyota Corolla in good condition';
		$posting->expires_at = $in_two_weeks;
		$posting->closed = false;
		$posting->title = 'Corolla';
		$posting->category_id = $auto;
		$posting->area = $faker->city;
		$posting->save();

		DB::table('questions')->delete();

		$asker = Sentry::getUserProvider()->findByLogin('test1@test.com');

		$question = Question::create(array(
			'user_id' => $asker->id,
			'posting_id' => $posting->id,
			'content' => 'How big is it?'
			));

		Question::create(array(
			'user_id' => $posting->user_id,
			'parent_id' => $question->id,
			'posting_id' => $posting->id,
			'content' => 'It\'s REALLY BIG DUDE'
			));


		// Create posting by banned user
		$troll = Sentry::getUserProvider()->findByLogin('ban@ban.com');
		$posting = new Posting;
		$posting->user_id = $troll->id;
		$posting->content = $faker->text;
		$posting->expires_at = $in_two_weeks;
		$posting->closed = false;
		$posting->title = 'Banned user post';
		$posting->category_id = $for_sale;
		$posting->area = $faker->city;
		$posting->save();

		for ($i=0; $i < 100; $i++) {
			$posting = new Posting;
			$posting->user_id = $firstUser->id + 1;
			$posting->content = $faker->text;
			$posting->expires_at = $in_two_weeks;
			$posting->closed = false;
			$posting->title = $faker->sentence(5);
			$posting->category_id = $for_sale;
			$posting->area = $faker->city;
			$posting->save();
		}
	}

}