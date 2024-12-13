<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string|max:500',
        ]);

        $post = Post::findOrFail($postId);

        $post->comments()->create([
            'author' => $validated['author'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('posts.show', $post->id);
    }
}
