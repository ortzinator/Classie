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

    public function testPostsLoad()
    {
        $this->get(route('posts.index'))
            ->assertOk()
            ->assertSee('Posts');
    }

    public function testUsesLayout()
    {
        $this->get(route('posts.index'))
            ->assertOk()
            ->assertSee('Classie');
    }

    public function testCreateFormLoads()
    {
        $this->user = User::factory()->create();
        $this->post = Post::factory()->make(['user_id' => $this->user->id]);

        $this->actingAs($this->user)
            ->get(route('posts.create'))
            ->assertOk()
            ->assertSee('Create Post');
    }

    public function testCanCreatePost()
    {
        $this->user = User::factory()->create();
        $this->post = Post::factory()->make(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
            ->post(route('posts.store', $this->post->getAttributes()))
            ->assertRedirect(route('posts.show', 1));

        $this->followRedirects($response)
            ->assertSee($this->post->title);
    }

    public function testCannotCreatePostWhileGuest()
    {
        $this->post = Post::factory()->make();

        $this->post(route('posts.store', $this->post->getAttributes()))
            ->assertRedirect(route('login'));
    }

    public function testSeeSubmittedPostInPostsList()
    {
        $this->post = Post::factory()->create();

        $this->get(route('posts.index'))
            ->assertOk()
            ->assertSee($this->post->title);
    }

    public function testCanLoadPost()
    {
        $this->post = Post::factory()->create();

        $this->get(route('posts.show', $this->post->id))
            ->assertOk()
            ->assertSee($this->post->title);
    }
}
