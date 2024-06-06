<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'body', 'user_id', 'media_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public static function list()
    {
        return self::all();
    }

    public static function storeOrUpate($request, $id = null)
    {
        if ($request->hasFile('image')) {

            $post = ['title' => $request->title, 'body' => $request->body, 'user_id' => $request->user_id, 'media_id' => Media::storeOrUpdate($request->file('image'))];
            $post = self::updateOrCreate(['id' => $id], $post);
            return $post;
        }
    }
}