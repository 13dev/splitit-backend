<?php

namespace Modules\Core\Tests;

use Tests\TestCase;

class BaseTest extends TestCase
{
    protected const API_PREFIX = '/api/';

    /**
     * Abstract url
     * @param $url
     * @return string
     */
    protected function url($url)
    {
        return env('APP_URL') . self::API_PREFIX . $url;
    }
}
