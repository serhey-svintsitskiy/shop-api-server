<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryArrayEnumParameter extends OA\QueryParameter
{
    /** @param string[]|int[]|float[]|\UnitEnum[]|class-string $enum */
    public function __construct(
        string $name,
        ?string $description = null,
        array|string|null $enum = null,
    ) {
        parent::__construct(
            name: $name . '[]',
            description: $description ?? $name,
            schema: new OA\Schema(
                type: 'array',
                items: new OA\Items(enum: $enum)
            )
        );
    }
}
