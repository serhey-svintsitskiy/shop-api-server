<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class ResponseNoContent extends OA\Response
{
    public function __construct(
        string $description = 'Success',
    ) {
        parent::__construct(
            response: Response::HTTP_NO_CONTENT,
            description: $description,
        );
    }
}
