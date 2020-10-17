<?php

namespace Modules\User\Services;

use Hash;
use Illuminate\Http\Request;
use Modules\Auth\Services\AuthService;
use Modules\Core\Support\ApiCode;
use Modules\Core\Support\Response;
use Modules\User\Http\Resources\UserResource;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepositoryInterface;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $repository;

    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(UserRepositoryInterface $repository, AuthService $authService)
    {
        $this->repository = $repository;
        $this->authService = $authService;
    }

    /**
     * Logout user.
     * @return Response
     */
    public function logout()
    {
        $this->authService->invalidateToken();

        return Response::success(null, ApiCode::CORE_SUCCESS_OK, 'Successfully logged out');
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
        $token = $this->authService->attemptLogin(
            $request->only(User::EMAIL, User::PASSWORD)
        );

        return Response::success(new UserResource($user, $token));
    }
}
