<?php

namespace App\Service\Common;

use App\Entity\Image;
use App\Repository\Common\ImageRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Uid\Ulid;

readonly class FileUploadService
{
    public function __construct(
        #[Autowire('%imageUploadDir%')]
        private string $targetDirectory,
        private ImageRepository $imageRepository,
    ) {
    }

    public function upload(UploadedFile $file): Image
    {
        $extension = $file->guessExtension() ?? '';
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $guid = (new Ulid())->toBase32();
        $uniqueName = sprintf('%s%s%s', $guid, strlen($extension) ? '.' : '', $extension);
        $subDirPath = $this->getSubdirPath($guid);

        $file->move($this->getTargetDirectory($subDirPath), $uniqueName);

        $image = (new Image())
            ->setSrc(sprintf('%s%s%s', $subDirPath, DIRECTORY_SEPARATOR, $uniqueName))
            ->setAlt($originalFilename);
        $this->imageRepository->save($image, true);

        return $image;
    }

    public function getTargetDirectory(string $subDirectoryPath): string
    {
        $baseTargetDir = sprintf(
            '%s%s',
            rtrim($this->targetDirectory, DIRECTORY_SEPARATOR),
            DIRECTORY_SEPARATOR
        );
        return sprintf('%s%s%s', $baseTargetDir, DIRECTORY_SEPARATOR, $subDirectoryPath);
    }

    private function getSubdirPath(string $ulid, int $nesting = 1): string
    {
        $parts = [];
        $length = 2;
        for ($i = 0; $i < $nesting; $i++) {
            $parts[] = substr($ulid, $length * $i, 2);
        }

        return join(DIRECTORY_SEPARATOR, array_values($parts));
    }
}
