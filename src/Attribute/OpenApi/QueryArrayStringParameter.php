<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryArrayStringParameter extends OA\QueryParameter
{
    public function __construct(
        string $name,
        ?string $description = null,
        string $type = 'string'
    ) {
        parent::__construct(
            name: $name . '[]',
            description: $description ?? $name,
            schema: new OA\Schema(
                type: 'array',
                items: new OA\Items(type: $type)
            )
        );
    }
}
