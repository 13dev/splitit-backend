<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Core\Support\Response;
use Modules\User\Services\UserService;

/**
 * @group Auth
 * Class AuthController
 * @package Modules\Auth\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Login
     * To do the login and get your access token.
     *
     * @bodyParam email string required Email of user to login.
     * @bodyParam password string required Password of user to login.
     * @apiResourceModel Modules\User\Models\User
     * @apiResource Modules\User\Http\Resources\UserResource
     * @param  LoginRequest  $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        return $this->userService->login($request);
    }

    /**
     * Logout
     *
     * Logout user (invalidate the token)
     * @return Response
     */
    public function logout()
    {
        return $this->userService->logout();
    }
}
