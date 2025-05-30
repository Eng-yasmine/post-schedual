<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\Traits\ApiResponseTrait;
use App\Http\Requests\StorePlatform_PostRequest;
use App\Models\Platform;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;

class PlatformController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platforms = Platform::withCount('users')->paginate(10);
        return view('user.pages.platforms.index', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platforms = Platform::latest()->get();
        return view('user.pages.platforms.create', compact('platforms'));
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePlatformRequest $request)
    {
        $data = $request->validated();
        $platform = Platform::create($data);
        return redirect()->back()->with('success', 'Platform added successfully.');
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
        //
    }
}
