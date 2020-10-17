<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Log;
use Modules\Core\Support\ApiCode;
use Modules\Core\Support\Response;
use Modules\User\Exceptions\UserNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        NotFoundHttpException::class,
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
        if ($this->shouldntReport($exception)) {
            Log::critical($exception->getMessage(), [
                'exception' => $exception,
            ]);
        }

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
            case UserNotFoundException::class:
                return Response::error(ApiCode::USER_NOT_FOUND);
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
