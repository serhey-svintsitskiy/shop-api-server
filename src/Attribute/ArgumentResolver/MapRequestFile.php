<?php

declare(strict_types=1);

namespace App\Attribute\ArgumentResolver;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
class MapRequestFile
{
    /**
     * @param Constraint[] $constraints
     */
    public function __construct(
        private readonly string $field,
        private readonly array $constraints = [],
    ) {
    }

    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return Constraint[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }
}
