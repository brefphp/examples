<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\Validator\Constraints as Assert;


class UploadModel
{
    /**
     * @Assert\Image(maxSize="5M")
     * @Assert\NotNull()
     *
     * @var null|UploadedFile
     */
    private $file;


    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile(?UploadedFile $file): void
    {
        $this->file = $file;
    }
}
