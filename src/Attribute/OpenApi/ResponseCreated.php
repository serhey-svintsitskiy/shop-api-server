<?php

declare(strict_types=1);

namespace App\Attribute\OpenApi;

use Attribute;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class ResponseCreated extends OA\Response
{
    public function __construct(
        string $type,
        string $description = 'Success',
    ) {
        parent::__construct(
            response: Response::HTTP_CREATED,
            description: $description,
            content: new OA\JsonContent(
                ref: new Model(type: $type),
            )
        );
    }
}
