<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Spatie\MediaLibrary\InteractsWithMedia;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userID = auth()->id();

        $query = Post::with(['platforms', 'media'])->where('user_id', $userID);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('schedualed_time', $request->date);
        }

        $posts = $query->latest()->paginate(10);

        return view('welcome', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platforms = Platform::all();

        return view('user.pages.posts.create', compact('platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $userId = auth()->id();
        $scheduledTime = $request->input('schedualed_time');

        $scheduledDate = Carbon::parse($scheduledTime)->startOfDay();
        $nextDate = (clone $scheduledDate)->endOfDay();


        $scheduledCount = Post::where('user_id', $userId)
            ->where('status', 'schedualed')
            ->whereBetween('schedualed_time', [$scheduledDate, $nextDate])
            ->count();

        $maxScheduledPostsPerDay = 10;

        if ($scheduledCount >= $maxScheduledPostsPerDay) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['schedualed_time' => 'You have reached the maximum number of scheduled posts for today']);
        }

        $data = $request->validated();
        $data['user_id'] = $userId;
        $post = Post::create($data);

        if ($request->has('platforms')) {
            $post->platforms()->sync($request->platforms);
        }

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('welcome')->with('success', 'Post created successfully');
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
        $userId = auth()->id();
        $scheduledTime = $request->input('schedualed_time');

        $scheduledDate = Carbon::parse($scheduledTime)->startOfDay();
        $nextDate = (clone $scheduledDate)->endOfDay();

        $scheduledCount = Post::where('user_id', $userId)
            ->where('status', 'schedualed')
            ->whereBetween('schedualed_time', [$scheduledDate, $nextDate])
            ->where('id', '!=', $post->id) // exclude current post
            ->count();

        $maxScheduledPostsPerDay = 10;

        if ($scheduledCount >= $maxScheduledPostsPerDay) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['schedualed_time' => 'You have reached the maximum number of scheduled posts for this day.']);
        }

        $data = $request->validated();
        $data['user_id'] = $userId;

        if ($request->hasFile('image')) {
            $post->clearMediaCollection('posts');
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        $post->update($data);

        return redirect()->route('welcome')->with('success', 'Post updated successfully');
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
