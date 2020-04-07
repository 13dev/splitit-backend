<?php

/**
 * Laravel API Response Builder - configuration file
 *
 * See docs/config.md for detailed documentation
 *
 * @author    Marcin Orlowski <mail (#) marcinOrlowski (.) com>
 * @copyright 2016-2020 Marcin Orlowski
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/MarcinOrlowski/laravel-api-response-builder
 */
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use MarcinOrlowski\ResponseBuilder\Converters\ArrayableConverter;
use MarcinOrlowski\ResponseBuilder\Converters\JsonSerializableConverter;
use MarcinOrlowski\ResponseBuilder\Converters\ToArrayConverter;
use Modules\Core\Support\ApiCodes;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

return [
    /*
    |-----------------------------------------------------------------------------------------------------------
    | Code range settings
    |-----------------------------------------------------------------------------------------------------------
    */
    'min_code'          => 100,
    'max_code'          => 1024,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Error code to message mapping
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'map'               => [
        ApiCodes::USER_NOT_FOUND => 'user::api.not_found',
        ApiCodes::CORE_AUTH_ERROR => 'core::auth_error',
        ApiCodes::CORE_GENERIC_ERROR => 'core::generic_error',
    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Response Builder data converter
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'converter'         => [
        Model::class          => [
            'handler' => ToArrayConverter::class,
            // 'key'     => 'item',
            'pri'     => 0,
        ],
        \Illuminate\Support\Collection::class               => [
            'handler' => ToArrayConverter::class,
            // 'key'     => 'item',
            'pri'     => 0,
        ],
        Collection::class     => [
            'handler' => ToArrayConverter::class,
            // 'key'     => 'item',
            'pri'     => 0,
        ],
        JsonResource::class => [
            'handler' => ToArrayConverter::class,
            // 'key'     => 'item',
            'pri'     => 0,
        ],

        /*
        |-----------------------------------------------------------------------------------------------------------
        | Converters for generic classes should use lower priority to allow dedicated converters to be used.
        |-----------------------------------------------------------------------------------------------------------
        */
        JsonSerializable::class                            => [
            'handler' => JsonSerializableConverter::class,
            // 'key'     => 'item',
            'pri'     => -10,
        ],
        Arrayable::class      => [
            'handler' => ArrayableConverter::class,
            // 'key'     => 'item',
            'pri'     => -10,
        ],

    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Exception handler error codes
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'exception_handler' => [
        /*
         * The following options can be used for each entry specified:
         * `api_code`   : (int) mandatory api_code to be used for given exception
         * `http_code`  : (int) optional HTTP code. If not specified, exception's HTTP status code will be used.
         * `msg_key`    : (string) optional localization string key (ie. 'app.my_error_string') which will be used
         *                if exception's message is empty. If `msg_key` is not provided, ExceptionHandler will
         *                fall back to built-in message.
         * `msg_enforce`: (boolean) if `true`, then fallback message (either one specified with `msg_key`, or
         *                built-in one will **always** be used, ignoring exception's message string completely.
         *                If set to `false` (default) then it will enforce either built-in message (if no
         *                `msg_key` is set, or message referenced by `msg_key` completely ignoring exception
         *                message ($ex->getMessage()).
         */
        'map' => [
            /*
             * HTTP Exceptions
             * ---------------
             * Configure how you want Http Exception to be handled based on its Http status code.
             * For each code you need to define at least the `api_code` to be returned in final response.
             * Additionally, you can specify `http_code` to be any valid 400-599 HTTP status code, otherwise
             * code set in the exception will be used.
             */
            HttpException::class => [
                // used by unauthenticated() to obtain api and http code for the exception
                ResponseCode::HTTP_UNAUTHORIZED => [
                    'api_code'  => ApiCodes::CORE_AUTH_ERROR,
                ],

                // Required by ValidationException handler
                ResponseCode::HTTP_UNPROCESSABLE_ENTITY => [
                    'api_code'  => ApiCodes::CORE_VALIDATION_ERROR,
                ],

                // default handler is mandatory and MUST have both `api_code` and `http_code` set.
                'default'                               => [
                    'api_code'  => ApiCodes::CORE_GENERIC_ERROR,
                    'http_code' => ResponseCode::HTTP_BAD_REQUEST,
                ],
            ],
            // This is final exception handler. If ex is not dealt with yet this is its last stop.
            // default handler is mandatory and MUST have both `api_code` and `http_code` set.
            'default'            => [
                'api_code'  => ApiCodes::CORE_GENERIC_ERROR,
                'http_code' => ResponseCode::HTTP_INTERNAL_SERVER_ERROR,
            ],
        ],
    ],

    /*
    |-----------------------------------------------------------------------------------------------------------
    | data-to-json encoding options
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'encoding_options'  => JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE,

    /*
    |-----------------------------------------------------------------------------------------------------------
    | Debug config
    |-----------------------------------------------------------------------------------------------------------
    |
    */
    'debug'             => [
        'debug_key'         => 'debug',
        'exception_handler' => [
            'trace_key'     => 'trace',
            'trace_enabled' => env('APP_DEBUG', false),
        ],
    ],

];
