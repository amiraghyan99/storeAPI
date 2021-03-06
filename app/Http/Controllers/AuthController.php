<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('login', 'register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));

        //

        return response()->json([
            'status' => 1,
            'message' => 'User successfully registered.',
            'user' => $user
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out', 'status' => 1]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        $user = auth()->user();
        if ($user->isSeller()) {
            $user = $user->load('stores');
        }

        return response()->json($user);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'status' => 1,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 60
        ]);
    }
}
