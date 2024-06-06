<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\ShowPostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::list();
        return response()->json([
            'success' => true,
            'message' => 'Here are all of your posts',
            'data' => PostResource::collection($posts),
            'post_count' => $posts->count()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::storeOrUpate($request);
        return response()->json([
            'success' => true,
            'message' => 'You successfully created a new post',
            'data' => new PostResource($post),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        return $post ? response()->json([
            'success' => true,
            'message' => 'Resource was successfully retrieved with the id: '.$id,
            'data' => new ShowPostResource($post)
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Resource was not found with the id: '.$id,
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        return $post ? response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => new PostResource(Post::storeOrUpate($request, $id))
        ], 200) : response()->json([
            'success' => false,
            'message' => 'Something went wrong!',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post = $post ? $post->delete() : false;

        return $post ? response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ], 200): response()->json([
            'success' => false,
            'message' => 'Failed to delete the post',
        ], 404);
    }
}