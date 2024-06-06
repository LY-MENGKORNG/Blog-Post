<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'title' => $this->title, 
            'body' => $this->body, 
            'image' => 'http://localhost:8000/storage/images/'.$this->media->image,
            'author' => $this->user->name
        ];
    }
}
