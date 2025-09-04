<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostDeleteRequest;
use App\Http\Requests\PostStatusChangeRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with(['tags', 'user'])->where('status', Post::STATUS_PUBLISHED)->latest()->get();
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function myPosts() {
        $posts = Post::with('tags')->where('created_by', auth()->user()->id)->latest()->get();
        return view('post.my-posts', [
            'posts' => $posts
        ]);
    }

    public function addPost() {
        $tags = Tag::all();
        return view('post.add', ['tags' => $tags]);
    }

    public function delete(PostDeleteRequest $request) {
        $validated = $request->validated();

        $post = Post::find($validated['POST_ID']);
        $post->delete();

        return redirect()->route('posts.my');
    }

    public function create(PostAddRequest $request) {
        $validated = $request->validated();

        $newPost = new Post;
        $newPost->title = $validated['title'];
        $newPost->text = $validated['text'];
        $newPost->status = $request->input('publish') === 'on' ? Post::STATUS_PENDING : Post::STATUS_DRAFT;
        $newPost->created_by = $request->user()->id;
        $newPost->save();

        $newPost->tags()->attach($validated['tags']);
        $newPost->save();

        return redirect(route('posts.my'));
    }

    public function requests(Request $request) {
        $posts = Post::with('tags')->where('status', Post::STATUS_PENDING)->latest()->get();
        return view('post.requests', [
            'posts' => $posts
        ]);
    }

    public function statusChange(PostStatusChangeRequest $request) {
        $validatedData = $request->validated();

        $post = Post::find($validatedData['POST_ID']);
        $post->status = $validatedData['STATUS'];
        $post->save();

        return redirect()->back();
    }
}
