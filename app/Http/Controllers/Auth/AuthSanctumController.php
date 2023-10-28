<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthSanctumController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        
        $request->authenticate();

        $email = $request->only('email')['email'];

        $user = User::where('email', $email)->first();


        $response = [
            'token' => $user->createToken('token-name', ['server:update'])->plainTextToken
        ];


        return response($response, 201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {

        $request->user()->currentAccessToken()->delete();

        return response([
            "message" => "logout"
        ]);
    }
}
