<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostAddRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxTitle = Post::MAX_TITLE_LENGTH;
        $maxContent = Post::MAX_STORY_LENGTH;

        return [
            'title' => "required|max:$maxTitle",
            'text' => "required|min:20|max:$maxContent",
            'tags' => 'required|exists:tags,id',
        ];
    }
}
