<?php

namespace Modules\User\Exceptions;

use Modules\Core\Exceptions\CoreException;
use Modules\Core\Support\ApiCode;

class UserNotFoundException extends CoreException
{
    protected $code = ApiCode::USER_NOT_FOUND;
}
