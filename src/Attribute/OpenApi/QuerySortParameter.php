<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QuerySortParameter extends OA\QueryParameter
{
    public function __construct(
        string $type,
        string $name = 'sort',
    ) {
        parent::__construct(
            name: $name,
            description: 'Sort',
            attachables: [new Model(type: $type)]
        );
    }
}
