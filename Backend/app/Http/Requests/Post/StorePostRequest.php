<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\DefaultRequest;

class StorePostRequest extends DefaultRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required'
        ];
    }
}
