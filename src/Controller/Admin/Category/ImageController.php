<?php

declare(strict_types=1);

namespace App\Controller\Admin\Category;

use App\Attribute\ArgumentResolver\MapRequestFile;
use App\Attribute\OpenApi as AOA;
use App\Entity\Category;
use App\Entity\Image;
use App\Model\Admin\Category\CategoryModel;
use App\Service\Admin\Category\ImageService;
use OpenApi\Attributes as OA;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route(path: '/api/admin/categories')]
#[OA\Tag(name: 'categories')]
class ImageController extends AbstractController
{
    public function __construct(
        private readonly ImageService $imageService,
    ) {
    }

    #[Route(path: '/{id}/images', methods: [Request::METHOD_POST], format: 'json')]
    #[AOA\RequestFile]
    #[AOA\ResponseOk(type: CategoryModel::class)]
    public function create(
        #[MapEntity]
        Category $category,
        #[MapRequestFile(field: 'file', constraints: [
            new Assert\NotNull(),
            new Assert\Image(maxSize: '2M', mimeTypes: ['image/*']),
        ])]
        UploadedFile $file,
    ): Response {
        $this->imageService->upload($category, $file);

        return $this->json(CategoryModel::fromEntity($category));
    }

    #[Route(path: '/{categoryId}/images/{imageId}', methods: [Request::METHOD_DELETE], format: 'json')]
    #[AOA\RequestFile]
    #[AOA\ResponseOk(type: CategoryModel::class)]
    public function remove(
        #[MapEntity(mapping: ['categoryId' => 'id'])]
        Category $category,
        #[MapEntity(mapping: ['imageId' => 'id'])]
        Image $file
    ): Response {
        $this->imageService->remove($category, $file);

        return $this->json(CategoryModel::fromEntity($category));
    }
}
