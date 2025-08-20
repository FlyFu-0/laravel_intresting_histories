<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        //TODO: make handler for unauth user
        if (!$request->user() || !$request->user()->id) {
            return redirect(route('login'));
        }

        $posts = Post::where('status', Post::STATUS_PUBLISHED)->latest()->get();
        return view('post.feed', [
            'posts' => $posts
        ]);
    }

    public function myPosts(Request $request) {
        $posts = Post::where('created_by', $request->user()->id)->latest()->get();

        return view('post.my-posts', [
            'posts' => $posts
        ]);
    }

    public function addPost(Request $request) {

        if ($request->isMethod(Request::METHOD_POST)) {
            $newPost = new Post;
            $newPost->title = $request->input('title');
            $newPost->text = $request->input('text');
            $newPost->created_by = $request->user()->id;
            $newPost->save();

            return redirect(route('my-posts'));
        }

        $tags = Tag::all();
        return view('post.add', ['tags' => $tags]);
    }

    public function requests(Request $request) {
        $posts = Post::all()->where('status', Post::STATUS_PENDING);
        return view('post.requests', [
            'posts' => $posts
        ]);
    }

    public function statusChange(Request $request) {
        $post = Post::find($request->get('POST_ID'));
        $post->status = $request->get('STATUS');
        $post->save();
        return redirect()->back();
    }
}
