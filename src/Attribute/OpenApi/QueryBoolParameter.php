<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryBoolParameter extends OA\QueryParameter
{
    public function __construct(
        string $name,
        string $description = '',
    ) {
        parent::__construct(
            name: $name,
            description: $description,
            schema: new OA\Schema(type: 'boolean')
        );
    }
}
