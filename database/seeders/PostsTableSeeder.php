<?php

namespace Database\Seeders;

use Classie\Models\Post;
use Classie\Models\User;
use Illuminate\Database\Seeder;


class PostsTableSeeder extends Seeder
{
    public function run()
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'admin@classie.com',
            'password' => bcrypt('password')
        ]);
        Post::factory()
            ->count(50)
            ->create([
                'user_id' => $user->id
            ]);
    }
}
