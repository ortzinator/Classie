<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $user = TestDummy::create('Classie\User');
        TestDummy::times(50)->create('Classie\Post',
            [
                'user_id' => $user->id

            ]);
    }
}
