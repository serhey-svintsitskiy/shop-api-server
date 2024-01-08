<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Attribute\ArgumentResolver\MapRequestFile;
use App\Attribute\OpenApi as AOA;
use App\Entity\Image;
use App\Entity\Product;
use App\Model\Admin\Product\ProductModel;
use App\Service\Admin\Product\ImageService;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route(path: '/api/admin/products')]
#[OA\Tag(name: 'products')]
class ImageController extends AbstractController
{
    public function __construct(
        private readonly ImageService $imageService,
    ) {
    }

    #[Route(path: '/{id}/images', methods: [Request::METHOD_POST], format: 'json')]
    #[AOA\RequestFile]
    #[AOA\ResponseOk(type: ProductModel::class)]
    public function create(
        #[MapEntity]
        Product $product,
        #[MapRequestFile(field: 'file', constraints: [
            new Assert\NotNull(),
            new Assert\Image(maxSize: '2M', mimeTypes: ['image/*']),
        ])]
        UploadedFile $file,
    ): Response {
        $this->imageService->upload($product, $file);

        return $this->json(ProductModel::fromEntity($product));
    }

    #[Route(path: '/{productId}/images/{imageId}', methods: [Request::METHOD_DELETE], format: 'json')]
    #[AOA\RequestFile]
    #[AOA\ResponseOk(type: ProductModel::class)]
    public function remove(
        #[MapEntity(mapping: ['productId' => 'id'])]
        Product $product,
        #[MapEntity(mapping: ['imageId' => 'id'])]
        Image $file
    ): Response {
        $this->imageService->remove($product, $file);

        return $this->json(ProductModel::fromEntity($product));
    }
}
