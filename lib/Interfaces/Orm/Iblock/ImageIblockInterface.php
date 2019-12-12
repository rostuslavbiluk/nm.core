<?php

namespace Vendor\Interfaces\Orm\Iblock;

use Vendor\Interfaces\Orm\Model\Image;

/**
 * Interface ImageIblockInterface
 * @package Vendor\Interfaces\Orm\Iblock
 */
interface ImageIblockInterface
{
    /**
     * @return int
     */
    public function getImageId(): int;

    /**
     * @return Image|null
     */
    public function getImage(): ?Image;

    /**
     * @return array|null
     */
    public function getImageFormatted(): ?array;

    /**
     * @param int|Image $image
     */
    public function setImage($image): void;
}
