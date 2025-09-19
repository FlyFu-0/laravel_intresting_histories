<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function create(Request $request, int $id)
    {
        $like = Like::where('user_id', auth()->user()->id)
            ->where('post_id', $id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $like = new Like();
            $like->post()->associate($id);
            $like->user()->associate(auth()->user()->id);
            $like->save();
        }

        return redirect()->back();
    }
}
