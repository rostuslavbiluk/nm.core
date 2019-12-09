<?php

namespace Vendor\Exception\Iblock;

use Exception;
use Throwable;

/**
 * Class ElementNotFoundException
 * @package Vendor\Exception\Iblock
 */
class ElementNotFoundException extends Exception
{
    /**
     * ElementNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = 'Элемент не найден', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}