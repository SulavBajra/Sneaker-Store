<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user();
        if ($user->isAdmin()) {
            RateLimiter::hit($request->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($request->throttleKey());

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
