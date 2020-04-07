<?php

namespace Modules\Core\Support;

use Lang;

class ApiCode
{
    //Core 10 - 100
    public const CORE_ERROR_VALIDATION = 10;
    public const CORE_ERROR_GENERIC = 11;
    public const CORE_SUCCESS_OK = 12;

    //Auth 101 - 150
    public const AUTH_ERROR = 101;
    public const AUTH_ERROR_LOGIN = 102;
    public const AUTH_ERROR_TOKEN = 103;
    public const AUTH_ERROR_TOKEN_EXPIRED = 104;

    // User 151 - 300
    public const USER_NOT_FOUND = 151;

    /**
     * Get message associated at api_code
     * @param  int  $code
     * @return mixed
     */
    public static function message(int $code)
    {
        return Lang::get(config("core.messages_map.{$code}.message"));
    }

    /**
     * Get status code of code
     * @param  int  $code
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function status(int $code)
    {
        return config("core.messages_map.{$code}.status", 200);
    }
}
