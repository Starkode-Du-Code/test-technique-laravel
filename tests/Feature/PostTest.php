<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_post()
    {
        $response = $this->post(route('posts.store'), [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
        ]);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    public function test_it_can_show_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post->id));
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_it_can_update_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->put(route('posts.update', $post->id), [
            'title' => 'Updated Title',
            'content' => 'Updated Content.',
        ]);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }

    public function test_it_can_delete_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post->id));
        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
