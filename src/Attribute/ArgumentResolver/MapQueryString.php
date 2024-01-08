<?php

namespace App\Attribute\ArgumentResolver;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString as SymfonyMapQueryString;
use App\ArgumentResolver\RequestPayloadValueResolver as CustomRequestPayloadValueResolver;
use Symfony\Component\Validator\Constraints\GroupSequence;


#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MapQueryString extends SymfonyMapQueryString
{
    /** with predefined CustomRequestPayloadValueResolver */
    /* @phpstan-ignore-next-line */
    public function __construct(
        array $serializationContext = [],
        string|GroupSequence|array|null $validationGroups = null,
        string $resolver = CustomRequestPayloadValueResolver::class,
        int $validationFailedStatusCode = Response::HTTP_NOT_FOUND,
    ) {
        parent::__construct($serializationContext, $validationGroups, $resolver, $validationFailedStatusCode);
    }
}
