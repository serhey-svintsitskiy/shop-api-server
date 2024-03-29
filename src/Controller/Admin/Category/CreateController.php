<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Attribute\OpenApi as AOA;
use App\Model\Admin\Category\CategoryModel;
use App\Model\Admin\Category\CreateRequest;
use App\Service\Admin\Category\CreateCategoryService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/categories')]
#[OA\Tag(name: 'categories')]
class CreateController extends AbstractController
{
    public function __construct(
        private readonly CreateCategoryService $createCategoryService,
    ) {
    }

    #[Route(path: '', methods: [Request::METHOD_POST], format: 'json')]
    #[AOA\RequestBody(type: CreateRequest::class)]
    #[AOA\ResponseOk(type: CategoryModel::class)]
    public function create(
        #[MapRequestPayload(validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY)]
        CreateRequest $request,
    ): Response {
        $category = $this->createCategoryService->create($request);

        return $this->json(CategoryModel::fromEntity($category));
    }
}
