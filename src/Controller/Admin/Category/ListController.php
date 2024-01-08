<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Attribute\ArgumentResolver\MapQueryString;
use App\Attribute\OpenApi as AOA;
use App\Entity\Category;
use App\Model\Admin\Category\ListRequest;
use App\Model\Admin\Category\ListResponse;
use App\Model\Admin\Category\CategoryModel;
use App\Repository\Common\CategoryRepository;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/categories')]
#[OA\Tag(name: 'categories')]
class ListController extends AbstractController
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    ) {
    }

    #[Route(path: '', methods: [Request::METHOD_GET], format: 'json')]
    #[AOA\QueryPageParameter]
    #[AOA\ResponseOk(type: ListResponse::class)]
    public function getList(
        #[MapQueryString]
        ListRequest $request,
    ): Response {
        return $this->json(
            new ListResponse(
                CategoryModel::fromCollection($this->categoryRepository->findAll())
            )
        );
    }

    #[Route(path: '/{id}', methods: [Request::METHOD_GET])]
    #[AOA\ResponseOk(type: CategoryModel::class)]
    public function getItem(
        #[MapEntity]
        Category $category,
    ): Response {
        return $this->json(CategoryModel::fromEntity($category));
    }
}
