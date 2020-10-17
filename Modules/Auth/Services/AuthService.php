<?php

namespace Modules\Auth\Services;

use JWTAuth;
use Modules\Core\Support\ApiCode;
use Modules\Core\Support\Response;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthService
{
    /**
     * Attempt to login with given credentials.
     * @param $credentials
     * @return Response|string
     */
    public function attemptLogin($credentials)
    {
        try {
            // Expired Time 28days
            //JWTAuth::factory()->setTTL(40320);

            if (!$token = JWTAuth::attempt($credentials)) {
                return Response::error(ApiCode::AUTH_ERROR_LOGIN);
            }

            return $token;
        } catch (JWTException $e) {
            return Response::error(ApiCode::AUTH_ERROR_TOKEN);
        }
    }

    /**
     * Invalidate the current token.
     * @return Response
     */
    public function invalidateToken()
    {
        try {
            $token = JWTAuth::getToken();

            JWTAuth::invalidate($token);
        } catch (\Exception $e) {
            return Response::error(ApiCode::CORE_ERROR_GENERIC);
        }
    }
}
