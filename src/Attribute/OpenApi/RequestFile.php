<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER | Attribute::IS_REPEATABLE)]
class RequestFile extends OA\RequestBody
{
    public function __construct(
        bool $required = true
    ) {
        parent::__construct(
            required: $required,
            content: new OA\MediaType(
                'multipart/form-data',
                new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: 'file',
                            type: 'string',
                            format: 'binary'
                        ),
                    ],
                    type: 'object'
                ),
            ),
        );
    }


}
