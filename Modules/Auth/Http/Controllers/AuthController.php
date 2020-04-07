<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Core\Support\Response;
use Modules\User\Services\UserService;

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
     * @param  LoginRequest  $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        return $this->userService->login($request);
    }
}
