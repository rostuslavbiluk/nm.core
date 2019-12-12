<?php

namespace Vendor\Interfaces\Orm\Iblock;

use Bitrix\Main\Type\DateTime;

/**
 * Interface DateBeginIblockInterface
 * @package Vendor\Interfaces\Orm\Iblock
 */
interface DateBeginIblockInterface
{
    /**
     * @return DateTime
     */
    public function getDateBegin(): ?DateTime;

    /**
     * @return array
     */
    public function getDateBeginFormatted(): array;

    /**
     * @return string
     */
    public function getDateBeginReal(): string;

    /**
     * @param DateTime|int $dateBegin
     *
     * @return DateBeginIblockInterface
     */
    public function setDateBegin($dateBegin): DateBeginIblockInterface;
}