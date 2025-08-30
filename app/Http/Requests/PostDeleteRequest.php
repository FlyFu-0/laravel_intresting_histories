<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = Post::find($this->get('POST_ID'));

        if (!$post) {
            return false;
        }

        if ($this->user()->isAdmin()) {
            return true;
        }

        return $this->user()->id === $post->created_by;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'POST_ID' => 'required|exists:posts,id',
        ];
    }
}
