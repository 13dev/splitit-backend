<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;

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

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  Exception  $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Exception
     */
    public function render($request, Exception $exception)
    {
        return ExceptionHandlerHelper::render($request, $exception);

//        switch (get_class($exception)) {
//
//            case ValidationException::class:
//                return ResponseBuilder::error(
//                    ApiCodes::CORE_VALIDATION_ERROR,
//                    null,
//                    $exception->validator->errors(),
//                    );
//                break;
//
//            case AuthorizationException::class:
//                return ResponseBuilder::error(ApiCodes::CORE_AUTH_ERROR);
//                break;
//
//            default:
//                return ResponseBuilder::asError(ApiCodes::CORE_GENERIC_ERROR)
//                    ->withMessage(
//                        app()->environment() !== 'production'
//                            ? $exception->getMessage()
//                            : null
//                    )->build();
//                break;
//        }
    }
}
