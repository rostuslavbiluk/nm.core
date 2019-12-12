<?php

namespace Vendor\Interfaces\Orm\Iblock;

use Bitrix\Main\Type\DateTime;

/**
 * Interface DateCreateIblockInterface
 * @package Vendor\Interfaces\Orm\Iblock
 */
interface DateCreateIblockInterface
{
    /**
     * @return DateTime
     */
    public function getDateCreate(): DateTime;

    /**
     * @return int
     */
    public function getDateCreateReal(): int;

    /**
     * @return array
     */
    public function getDateCreateFormatted(): array;
}