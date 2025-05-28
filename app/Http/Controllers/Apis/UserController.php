<?php


namespace App\Http\Controllers\Apis;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Apis\Traits\ApiResponseTrait;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function register(StoreUserRequest $request)
    {
        $userData = $request->validated();

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),

        ]);

        if ($user) {
            return $this->successResponse([
                'name' => $user->name,
                'email' => $user->email,

            ], 'success registered', 201);
        } else {
            return $this->errorResponse('invalid data', 400, ['email' => 'invalid email', 'password' => 'week password']);
        }
    }

    public function login(Request $request, User $user)
    {
        $credential = $request->only('email', 'password');

        if (!Auth::attempt($credential)) {
            return $this->errorResponse(
                'invalid email or password',
                401,
                ['email' => 'invalid email', 'password' => 'invalid password']
            );
        }
        $user = Auth::user();
        // $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(
            [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ],
            'login success',
            200
        );
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user && $user?->currentAccessToken()) {
            $user->currentAccessToken()->delete();

            return $this->successResponse(
                [],
                'login success',
                201
            );
        }
        return $this->errorResponse(
            'logout failed',
            401,
            ['email' => 'invalid email', 'password' => 'invalid password']
        );
    }

}
