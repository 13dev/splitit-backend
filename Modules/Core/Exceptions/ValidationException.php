<?php

namespace Modules\Core\Exceptions;

use Modules\Core\Support\ApiCode;

class ValidationException extends CoreException
{
    protected $code = ApiCode::CORE_ERROR_VALIDATION;
}
