<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\DefaultRequest;

class UpdatePostRequest extends DefaultRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|mimes:jpeg,jpg,png,gif|required|max:10000'
        ];
    }
}
