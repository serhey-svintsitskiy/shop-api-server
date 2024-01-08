<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Attribute\ArgumentResolver\MapRequestFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

readonly class RequestFileArgumentResolver implements ValueResolverInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /** @phpstan-ignore-next-line */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $attributes = $argument->getAttributes(MapRequestFile::class, ArgumentMetadata::IS_INSTANCEOF);
        if (!$attributes) {
            return [];
        }

        /** @var MapRequestFile $attribute */
        $attribute = $attributes[0];

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get($attribute->getField());

        $violations = $this->validator->validate($uploadedFile, $attribute->getConstraints());
        if (\count($violations)) {
            throw new HttpException(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                implode("\n", array_map(static fn ($e) => $e->getMessage(), iterator_to_array($violations))),
                new ValidationFailedException($attribute, $violations)
            );
        }

        return [$uploadedFile];
    }
}
