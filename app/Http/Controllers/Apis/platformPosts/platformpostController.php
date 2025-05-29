<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlatform_PostRequest;
use App\Models\Platform;
use App\Models\Platform_post;
use App\Models\Post_Platform;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatform_postRequest;

use App\Http\Controllers\Apis\Traits\ApiResponseTrait;

class platformpostController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = auth()->user();

        $platforms = Platform::all()->map(function($platform) use ($user) {
            return [
                'id' => $platform->id,
                'name' => $platform->name,
                'type' => $platform->type,
                'active' => $user->platforms()->where('platform_id', $platform->id)->exists()
            ];
        });

        return $$this->successResponse(['platforms' => $platforms],200);
    }

    public function toggle(StorePlatformRequest $request)
    {
        $user = auth()->user();
        $platformId = $request->platform_id;

        if ($user->platforms()->where('platform_id', $platformId)->exists()) {
            $user->platforms()->detach($platformId);
            return $this->successResponse(['message' => 'Platform deactivated'], 200);
        } else {
            $user->platforms()->attach($platformId);
            return $this->successResponse(['message' => 'Platform activated'], 200);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlatform_PostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform_post $platform_post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform_post $platform_post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlatform_postRequest $request, Platform_post $platform_post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform_post $platform_post)
    {
        //
    }
}
