<?php

namespace Modules\User\Services;

use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Modules\Core\Support\ApiCode;
use Modules\Core\Support\Response;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepositoryInterface;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService
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
     * Attempt to login user.
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        // Search user by email
        try {
            $user = $this->repository->byEmail($request->email);
        } catch (\Exception $exception) {
            return Response::error(ApiCode::AUTH_ERROR_LOGIN);
        }

        // Account Validation
        $password = $request->input(User::PASSWORD);

        if (!Hash::check($password, $user->password)) {
            return Response::error(ApiCode::AUTH_ERROR_LOGIN);
        }

        // Login Attempt
        $credentials = $request->only(User::EMAIL, User::PASSWORD);

        try {

            // Expired Time 28days
            //JWTAuth::factory()->setTTL(40320);
            //$customClaims = ;

            if (!$token = JWTAuth::attempt($credentials)) {
                return Response::error(ApiCode::AUTH_ERROR_LOGIN);
            }
        } catch (JWTException $e) {
            return Response::error(ApiCode::AUTH_ERROR_TOKEN);
        }

        return Response::success(new UserResource($user, $token));
    }
}
