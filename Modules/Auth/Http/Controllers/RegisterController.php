<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

/**
 * @group Auth
 * Class RegisterController
 * @package Modules\Auth\Http\Controllers
 */
class RegisterController extends Controller
{
    /**
     * Register
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            User::NAME => $request->name,
            User::EMAIL => $request->email,
            User::PASSWORD => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        $data = new UserResource($user);

        return response()->json(compact('token', 'data'));
    }
}
