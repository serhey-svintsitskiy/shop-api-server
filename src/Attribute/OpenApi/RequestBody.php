<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER | Attribute::IS_REPEATABLE)]
class RequestBody extends OA\RequestBody
{
    public function __construct(
        string $type = 'string'
    ) {
        parent::__construct(
            attachables: [new Model(type: $type)]
        );
    }
}
