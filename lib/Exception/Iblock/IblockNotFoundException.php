<?php


namespace Vendor\Exception\Iblock;

use Exception;
use Throwable;

/**
 * Class IblockException
 * @package Vendor\Exception\Iblock
 */
class IblockNotFoundException extends Exception
{
    /**
     * IblockException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Инфоблок не найден', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}