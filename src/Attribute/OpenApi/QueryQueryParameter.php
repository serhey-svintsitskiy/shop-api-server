<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryQueryParameter extends OA\QueryParameter
{
    public function __construct(
        string $name = 'query',
    ) {
        parent::__construct(
            name: $name,
            description: 'Query',
            schema: new OA\Schema(type: 'string')
        );
    }
}
