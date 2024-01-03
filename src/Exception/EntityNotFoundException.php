<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class EntityNotFoundException extends RuntimeException
{
    public function __construct(
        string $message = "Entity not found"
    ) {
        parent::__construct($message);
    }
}
