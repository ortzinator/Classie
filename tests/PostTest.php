<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Classie\Post;
use Classie\User;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostsLoad()
    {
        $this->visit('/posts')
             ->see('Posts');
    }

    public function testUsesLayout()
    {
        $this->visit('/posts')
             ->see('Classie Classifieds');
    }

    public function testCreateFormLoads()
    {
        $this->visit('/posts/create')
             ->see('Create Post');
    }

    public function testCanCreatePost()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->make();

        $this->actingAs($user)
             ->visit('/posts/create')
             ->submitForm('Submit', ['title' => $post->title, 'body' => $post->body])
             ->seeInDatabase('posts', ['title' => $post->title])
             ->seePageIs('/posts');
    }

    public function testSeeSubmittedPostInPostsList()
    {
        $post = factory(Post::class)->create();

        $this->visit('/posts')
             ->see($post->title);
    }

    public function testCanLoadPost()
    {
        $post = factory(Post::class)->create();

        $this->visit('posts/' . $post->id)
             ->see($post->title)
             ->assertResponseOk();
    }
}
