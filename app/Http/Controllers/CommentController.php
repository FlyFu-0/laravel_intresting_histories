<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentAddRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getForPost(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)
            ->latest()
            ->get();

        return response()->json($comments);
    }

    public function create(CommentAddRequest $request, int $id)
    {
        $validated = $request->validated();

        $comment = new Comment();
        $comment->post()->associate($id);
        $comment->user()->associate(auth()->user());
        $comment->fill($validated);
        $comment->save();

        return redirect()->back();
    }
}
