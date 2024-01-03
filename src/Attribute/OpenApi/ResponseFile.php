<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY | Attribute::TARGET_PARAMETER | Attribute::IS_REPEATABLE)]
class ResponseFile extends OA\Response
{
    public function __construct(
        int|string $response = 200,
        null|string $description = "Returns file"
    ) {
        parent::__construct(
            response: $response,
            description: $description,
            content: new OA\MediaType(
                mediaType: "application/octet-stream",
                schema: new OA\Schema(
                    type: "string",
                    format: "binary"
                )
            )
        );
    }


}
