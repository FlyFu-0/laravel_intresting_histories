<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagAddRequest extends FormRequest
{
//    public function authorize(): bool
//    {
//        if ($this->user()->isAdmin()) {
//            return true;
//        }
//
//        return false;
//    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:tags|max:255',
        ];
    }
}
