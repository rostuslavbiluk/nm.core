<?php

namespace Vendor\Traits\Iblock;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\IO\FileNotFoundException;
use Vendor\Orm\Model\Image;

/**
 * Trait ImageIblockTrait
 * @package Vendor\Traits\Iblock
 */
trait ImageIblockTrait
{
    /** @var Image */
    protected $image;

    /**
     * @return int
     */
    public function getImageId(): int
    {
        return $this->getElement()->getPreviewPicture() ?? 0;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        if ($this->image === null) {
            $currentImage = $this->getImageId();
            if ($currentImage > 0) {
                $this->setImage($currentImage);
            }
        }
        return $this->image;
    }

    /**
     * @param int|Image $id
     */
    public function setImage($id): void
    {
        if (is_int($id) && $id > 0) {
            try {
                $this->image = Image::createFromPrimary($id);
                if ((int)$this->image->getId() > 0) {
                    $this->setPicture($id);
                }
            } catch (FileNotFoundException $e) {
                //файл не найден начит не выводим
            }
        } else {
            $this->image = $id;
        }
    }

    /**
     * @param int $id
     */
    protected function setPicture(int $id): void
    {
        $this->getElement()->setPreviewPicture($id);
    }

    /**
     * @return array|null
     */
    public function getImageFormatted(): ?array
    {
        /** @var Image $image */
        $image = $this->getImage();
        if ($image !== null) {
            try {
                $result = [];
            } catch (FileNotFoundException|ArgumentException $e) {
                //файл не найден начит не выводим
            }
        }
        return $result ?? null;
    }
}