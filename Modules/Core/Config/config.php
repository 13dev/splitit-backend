<?php

use Modules\Core\Support\ApiCode;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

return [
    'name' => 'Core',

    'messages_map' => [
        ApiCode::USER_NOT_FOUND => [
            'message' => 'core::api.user.not_found',
            'status' => ResponseCode::HTTP_NOT_FOUND,
        ],
        ApiCode::AUTH_ERROR => [
            'message' => 'core::api.auth.error_auth',
            'status' => ResponseCode::HTTP_UNAUTHORIZED,
        ],
        ApiCode::CORE_ERROR_GENERIC => [
            'message' => 'core::api.core.error_generic',
            'status' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR,
        ],
        ApiCode::CORE_ERROR_VALIDATION => [
            'message' => 'core::api.core.error_validation',
            'status' => ResponseCode::HTTP_BAD_REQUEST,
        ],
        ApiCode::AUTH_ERROR_LOGIN => [
            'message' => 'core::api.auth.error_login',
            'status' => ResponseCode::HTTP_UNAUTHORIZED,
        ],
        ApiCode::AUTH_ERROR_TOKEN => [
            'message' => 'core::api.auth.error_token',
            'status' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR,
        ],
    ],
];
