<?php

namespace Vendor\Traits\Orm\Entity\Iblock;

use Bitrix\Iblock\EO_Property;
use Bitrix\Iblock\EO_PropertyEnumeration;

/**
 * Trait DescriptionIblockTrait
 * @package Vendor\Traits\Orm\Entity\Iblock
 */
trait DescriptionIblockTrait
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getElement()->getDetailText() ?: '';
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription(?string $description)
    {
        $this->getElement()->setDetailText($description ?? '');
        return $this;
    }

}