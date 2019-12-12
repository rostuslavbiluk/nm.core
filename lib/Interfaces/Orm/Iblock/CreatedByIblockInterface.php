<?php

namespace Vendor\Interfaces\Orm\Iblock;

use Vendor\Orm\Model\UserCustom;

/**
 * Interface CreatedByIblockInterface
 * @package Vendor\Interfaces\Orm\Iblock
 */
interface CreatedByIblockInterface
{
    /**
     * @return UserCustom|null
     */
    public function getCreatedBy(): ?UserCustom;

    /**
     * @return array
     */
    public function getCreatedByFormatted(): array;

    /**
     * @return int|null
     */
    public function getCreatedByReal(): ?int;

    /**
     * @param $idUser
     *
     * @return CreatedByIblockInterface
     */
    public function setCreatedBy($idUser): CreatedByIblockInterface;
}