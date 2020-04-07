<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\Core\Support\ApiCode;
use Modules\Core\Support\ApiCodes;
use Modules\Core\Support\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    public function render($request, Exception $exception)
    {
        switch (get_class($exception)) {

            case TokenExpiredException::class:
                return Response::error(ApiCode::AUTH_ERROR_TOKEN_EXPIRED);
                break;
            case TokenInvalidException::class:
                return Response::error(ApiCode::AUTH_ERROR_TOKEN);
                break;
            case ValidationException::class:
                return new Response(
                    ApiCode::CORE_ERROR_VALIDATION,
                    $exception->validator->errors()
                );
                break;

            case AuthorizationException::class:
                return Response::error(ApiCode::AUTH_ERROR);
                break;

            default:
                $message = app()->environment() !== 'production'
                    ? $exception->getMessage()
                    : null;

                return new Response(ApiCode::CORE_ERROR_GENERIC, null, $message);
                break;
        }
    }
}
