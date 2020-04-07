<?php

namespace Modules\Core\Exceptions;

use Modules\Core\Support\ApiCode;
use Throwable;

class CoreException extends \Exception
{
    protected $code = ApiCode::CORE_ERROR_GENERIC;

    public function __construct(?int $code = null, Throwable $previous = null)
    {
        $message = ApiCode::message($code ?: $this->code);
        parent::__construct($message, $this->code, $previous);
    }
}
