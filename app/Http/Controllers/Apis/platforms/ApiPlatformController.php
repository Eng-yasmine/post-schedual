<?php

namespace App\Http\Controllers\Apis\platforms;

use App\Models\Platform;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;
use App\Http\Requests\StorePlatform_PostRequest;
use App\Http\Controllers\Apis\Traits\ApiResponseTrait;

class ApiPlatformController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::withCount('users')->paginate(10);
        return $platforms
            ? $this->successResponse(['data' => $platforms], 'platforms retrived successfully', 200)
            : $this->errorResponse('cant retrived platforms', 400, ['errors' => 'something ocured whiled retreving platforms']);
    }

    /**
     * Show the form for creating a new resource.
     */




    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePlatformRequest $request)
    {
        $data = $request->validated();
        $platform = Platform::create($data);
        return $platform
            ? $this->successResponse(['data' => $platform], 'Platform added successfully.', 201)
            : $this->errorResponse('platform cant retrived', 400, ['errors' => 'something ocured while adding platform']);
    }
    public function toggle(StorePlatform_PostRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $platformId = $request->platform_id;
        if ($user->platforms()->where('platform_id', $platformId)->exists()) {
            $user->platforms()->detach($platformId);
            return $this->successResponse(['message' => 'Platform deactivated'], 201);
        } else {
            $user->platforms()->attach($platformId);
            return $this->successResponse(['message' => 'Platform activated'], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Platform $platform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platform $platform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlatformRequest $request, Platform $platform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platform $platform)
    {
        $platform->delete();
        return $platform
            ? $this->successResponse(['data' => $platform], 'patform deleted successfully', 200)
            : $this->errorResponse('platform cant deleted', 400, ['errors' => 'something ocured while deleting platform']);
    }
}
