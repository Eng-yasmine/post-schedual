<?php

namespace App\Http\Controllers\Apis\Posts;


use Carbon\Carbon;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Controllers\Apis\Traits\ApiResponseTrait;

class ApiPostController extends Controller
{
    use ApiResponseTrait;

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

        return $posts
            ? $this->successResponse($posts, ['message' => 'All posts retrived successfully'], 200)
            : $this->errorResponse(400, ['errors' => 'somthing error ocured']);

    }


    /**
     * Show the form for creating a new resource.
     */


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
            return $this->errorResponse(['schedualed_time' => 'You have reached the maximum number of scheduled posts for today'], 400);
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
        return $post
            ? $this->successResponse(['data' => $post], 'post created successfully', 201)
            : $this->errorResponse('post doesnt created', 400, ['errors' => 'You have reached the maximum number of scheduled posts for today']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = $post->load(['platforms', 'media']);
        return $post
            ? $this->successResponse(['data' => $post], 'post created successfully', 201)
            : $this->errorResponse('post doesnt created', 400, ['errors' => 'You have reached the maximum number of scheduled posts for today']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

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
        return $post
            ? $this->successResponse(['data' => $post], 'post updated successfully', 201)
            : $this->errorResponse('post doesnt update', 400, ['errors' => 'You have reached the maximum number of scheduled posts for today']);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $post
            ? $this->successResponse(['data' => $post], 'post deleted successfully', 200)
            : $this->errorResponse('post doesnt delete', 400, ['errors' => 'somthing ocured while delete post ! please try again']);

    }

}
