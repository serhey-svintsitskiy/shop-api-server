<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryCountParameter extends QueryIntParameter
{
    public function __construct(
        string $name = 'count',
    ) {
        parent::__construct(
            name: $name,
            description: 'Items per page',
        );
    }
}
