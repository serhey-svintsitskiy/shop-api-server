<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Attribute\ArgumentResolver\MapQueryString;
use App\Attribute\OpenApi as AOA;
use App\Entity\Product;
use App\Model\Admin\Product\ListRequest;
use App\Model\Admin\Product\ListResponse;
use App\Model\Admin\Product\ProductModel;
use App\Repository\Common\ProductRepository;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api/admin/products')]
#[OA\Tag(name: 'products')]
class ListController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
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
                ProductModel::fromCollection($this->productRepository->findAll())
            )
        );
    }

    #[Route(path: '/{id}', methods: [Request::METHOD_GET])]
    #[AOA\ResponseOk(type: ProductModel::class)]
    public function getItem(
        #[MapEntity]
        Product $product,
    ): Response {
        return $this->json(ProductModel::fromEntity($product));
    }
}
