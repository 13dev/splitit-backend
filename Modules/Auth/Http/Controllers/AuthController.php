<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepositoryInterface;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        $user = $this->repository->byEmail($request->email);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        // Account Validation
        if (!Hash::check($request->input(User::PASSWORD), $user->password)) {
            return response()->json(['error' => 'Email or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        $credentials = $request->only(User::EMAIL, User::PASSWORD);

        try {

            // JWTAuth::factory()->setTTL(40320); // Expired Time 28days

            if (! $token = JWTAuth::attempt($credentials, ['exp' => Carbon::now()->addDays(28)->timestamp])) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $data = new UserResource($user);

        return response()->json(compact('token', 'data'));
    }
}
