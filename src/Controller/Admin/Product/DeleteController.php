<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Attribute\OpenApi as AOA;
use App\Entity\Category;
use App\Service\Admin\Category\DeleteService;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/products')]
#[OA\Tag(name: 'products')]
class DeleteController extends AbstractController
{
    public function __construct(
        private readonly DeleteService $deleteCategoryService,
    ) {
    }

    #[Route(path: '/{id}', methods: [Request::METHOD_DELETE], format: 'json')]
    #[AOA\ResponseNoContent]
    public function create(
        #[MapEntity]
        Category $category,
    ): Response {
        $this->deleteCategoryService->delete($category);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
