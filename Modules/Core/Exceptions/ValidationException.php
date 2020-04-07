<?php

namespace Modules\Core\Exceptions;

use Illuminate\Validation\ValidationException as BaseValidationException;
use Modules\Core\Support\ApiExceptionInterface;

class ValidationException extends BaseValidationException implements ApiExceptionInterface
{
    /**
     * @inheritDoc
     */
    public function statusCode(): int
    {
        // TODO: Implement statusCode() method.
    }

    /**
     * @inheritDoc
     */
    public function error(): string
    {
        // TODO: Implement error() method.
    }
}
