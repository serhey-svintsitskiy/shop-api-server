<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class QueryOrderByParameter extends OA\QueryParameter
{
    public function __construct(
        string $type,
        string $name = 'orderBy',
    ) {
        parent::__construct(
            name: $name,
            description: 'Sort order',
            attachables: [new Model(type: $type)]
        );
    }
}
