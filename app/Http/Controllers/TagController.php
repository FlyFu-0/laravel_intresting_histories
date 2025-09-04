<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagAddRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function all() {
        $tags = Tag::select('name', 'id')->get();

        return view('tag.all', ['tags' => $tags]);
    }

    public function create(TagAddRequest $request) {
        $validated = $request->validated();

        $tag = new Tag();
        $tag->name = $validated['name'];
        $tag->save();

        return redirect()->route('tags.all');
    }

    public function delete(Request $request, Tag $tag) {
        $tag->delete();
        return redirect()->route('tags.all');
    }
}
