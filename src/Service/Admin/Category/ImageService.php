<?php

namespace App\Service\Admin\Category;

use App\Entity\Category;
use App\Entity\Image;
use App\Repository\Common\CategoryRepository;
use App\Service\Common\FileUploadService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class ImageService
{
    public function __construct(
        private FileUploadService $fileUploadService,
        private CategoryRepository $categoryRepository,
    ) {
    }

    public function upload(Category $category, UploadedFile $file): Category
    {
        $image = $this->fileUploadService->upload($file);

        return $this->add($category, $image);
    }

    public function add(Category $category, Image $image): Category
    {
        $category->addImage($image);

        $this->categoryRepository->save($category, true);

        return $category;
    }

    public function remove(Category $category, Image $image): Category
    {
        if (!$category->getImages()->contains($image)) {
            throw new NotFoundHttpException('Could not find image');
        }
        $category->removeImage($image);

        $this->categoryRepository->save($category, true);

        return $category;
    }
}
