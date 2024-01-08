<?php

namespace App\Service\Admin\Product;

use App\Entity\Image;
use App\Entity\Product;
use App\Repository\Common\ProductRepository;
use App\Service\Common\FileUploadService;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class ImageService
{
    public function __construct(
        private FileUploadService $fileUploadService,
        private ProductRepository $productRepository,
    ) {
    }

    public function upload(Product $product, UploadedFile $file): Product
    {
        $image = $this->fileUploadService->upload($file);

        return $this->add($product, $image);
    }

    public function add(Product $product, Image $image): Product
    {
        $product->addImage($image);

        $this->productRepository->save($product, true);

        return $product;
    }

    public function remove(Product $product, Image $image): Product
    {
        if (!$product->getImages()->contains($image)) {
            throw new NotFoundHttpException('Could not find image');
        }
        $product->removeImage($image);

        $this->productRepository->save($product, true);

        return $product;
    }
}
