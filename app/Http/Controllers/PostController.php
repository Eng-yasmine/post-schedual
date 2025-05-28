<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Spatie\MediaLibrary\InteractsWithMedia;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'platforms', 'media'])->latest()->paginate(10);
        return view('user.pages.posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('user.pages.posts.create');
    }

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

        return redirect()->route('posts.index')->with('success', 'post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $post->load(['platforms', 'media']);
        return view('user.pages.posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('user.pages.posts.edit', $post->id);
    }

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

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

}
