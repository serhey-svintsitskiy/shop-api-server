<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Attribute\OpenApi as AOA;
use App\Model\Admin\Product\ProductModel;
use App\Model\Admin\Product\CreateRequest;
use App\Service\Admin\Product\CreateService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/products')]
#[OA\Tag(name: 'products')]
class CreateController extends AbstractController
{
    public function __construct(
        private readonly CreateService $createService,
    ) {
    }

    #[Route(path: '', methods: [Request::METHOD_POST], format: 'json')]
    #[AOA\RequestBody(type: CreateRequest::class)]
    #[AOA\ResponseCreated(type: ProductModel::class)]
    public function create(
        #[MapRequestPayload(validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY)]
        CreateRequest $request,
    ): Response {
        $product = $this->createService->create($request);

        return $this->json(ProductModel::fromEntity($product));
    }
}
