<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryPageParameter extends QueryIntParameter
{
    public function __construct(
        string $name = 'page',
    ) {
        parent::__construct(
            name: $name,
            description: 'Page',
        );
    }
}
