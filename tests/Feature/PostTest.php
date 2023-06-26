<?php

namespace Tests\Feature;

use Classie\Models\Post;
use Classie\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Post $post;

    public function tearDown(): void
    {
        unset($this->user);
        unset($this->post);

        parent::tearDown();
    }

    public function testPostsLoad()
    {
        $this->get(route('posts.index'))
            ->assertSee('Posts');
    }

    public function testUsesLayout()
    {
        $this->get(route('posts.index'))
            ->assertSee('Classie');
    }

    public function testCreateFormLoads()
    {
        $this->get(route('posts.create'))
            ->assertSee('Create Post');
    }

    public function testCanCreatePost()
    {
        $this->user = User::factory()->create();
        $this->post = Post::factory()->make(['user_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->post(route('posts.store', $this->post->getAttributes()));

        $this->post = Post::first();

        $this->get(route('posts.show', $this->post->id))
            ->assertSessionHasNoErrors()
            ->assertSee($this->post->title);
    }

    public function testSeeSubmittedPostInPostsList()
    {
        $this->post = Post::factory()->create();

        $this->get(route('posts.index'))
            ->assertSee($this->post->title);
    }

    public function testCanLoadPost()
    {
        $this->post = Post::factory()->create();

        $this->get(route('posts.show', $this->post->id))
            ->assertSee($this->post->title)
            ->assertOk();
    }
}
