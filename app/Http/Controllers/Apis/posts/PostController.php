<?php

namespace App\Http\Controllers\Apis\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Apis\Traits\ApiResponseTrait;

class PostController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'platforms', 'media'])->latest()->paginate(10);

        return $posts
            ? $this->successResponse([PostResource::collection($posts), 'All Posts'], 200)
            : $this->errorResponse('No posts found', 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        // dd(auth()->id());
        $posts = Post::create($data);
        if ($request->hasFile('image')) {
            $posts->addMediaFromRequest('image')->toMediaCollection('posts');
        }



        $post = Post::create($data);

        return $post
            ? $this->successResponse(new PostResource($post), 'Post created successfully', 201)
            : $this->errorResponse('Post creation failed', 500);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        $post->update($data);

        return $post
            ? $this->successResponse(new PostResource($post), 'Post updated successfully', 201)
            : $this->errorResponse('Post update failed', 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $post
            ? $this->successResponse(null, 'Post deleted successfully', 200)
            : $this->errorResponse('Post deletion failed', 500);
    }
}
