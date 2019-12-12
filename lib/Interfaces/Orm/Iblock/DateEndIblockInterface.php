<?php

namespace Vendor\Interfaces\Orm\Iblock;

use Bitrix\Main\Type\DateTime;

/**
 * Interface DateEndIblockInterface
 * @package Vendor\Interfaces\Orm\Iblock
 */
interface DateEndIblockInterface
{
    /**
     * @return DateTime
     */
    public function getDateEnd(): ?DateTime;

    /**
     * @return array
     */
    public function getDateEndFormatted(): array;

    /**
     * @return string
     */
    public function getDateEndReal(): string;

    /**
     * @param DateTime|int $dateEnd
     *
     * @return DateEndIblockInterface
     */
    public function setDateEnd($dateEnd): DateEndIblockInterface;
}