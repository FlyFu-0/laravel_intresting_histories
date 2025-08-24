<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostStatusChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = Post::find($this->get('POST_ID'));
        $newStatus = $this->get('STATUS');

        if (!$post) {
            return false;
        }

        if ($this->user()->isAdmin()) {
            return true;
        }


        return $this->user()->id === $post->created_by
            && $post->status === 'draft'
            && $newStatus === Post::STATUS_PENDING;
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
            'STATUS' => 'required|in:draft,pending,rejected,published',
        ];
    }
}
