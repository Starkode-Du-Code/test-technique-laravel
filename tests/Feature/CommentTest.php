<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_add_a_comment_to_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post->id), [
            'author' => 'Test Author',
            'content' => 'This is a test comment.',
        ]);

        $response->assertRedirect(route('posts.show', $post->id));
        $this->assertDatabaseHas('comments', ['content' => 'This is a test comment.']);
    }
}
