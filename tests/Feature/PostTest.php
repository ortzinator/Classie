<?php

namespace Tests\Feature;

use Classie\Models\Post;
use Classie\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostsLoad()
    {
        $this->get('/posts')
            ->assertSee('Posts');
    }

    public function testUsesLayout()
    {
        $this->get('/posts')
            ->assertSee('Classie');
    }

    public function testCreateFormLoads()
    {
        $this->get('/posts/create')
            ->assertSee('Create Post');
    }

    public function testCanCreatePost()
    {
        $user = User::factory()->create();
        $post = Post::factory()->make(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('posts.store', $post->getAttributes()));

        $post = Post::first();

        $this->get(route('posts.show', $post->id))
            ->assertSessionHasNoErrors()
            ->assertSee($post->title);
    }

    public function testSeeSubmittedPostInPostsList()
    {
        $post = Post::factory()->create();

        $this->get('/posts')
            ->assertSee($post->title);
    }

    public function testCanLoadPost()
    {
        $post = Post::factory()->create();

        $this->get('posts/' . $post->id)
            ->assertSee($post->title)
            ->assertOk();
    }
}
