<?php

namespace Vendor\Interfaces\Orm\Model;

/**
 * Interface FileInterface
 *
 * @package Vendor\Interfaces\Orm\Model
 */
interface FileInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getSrc(): string;

    /**
     * @return array
     */
    public function getFields(): array;

    /**
     * @return string
     */
    public function getFileName(): string;

    /**
     * @return string
     */
    public function getSubDir(): string;

    /**
     * @return string
     */
    public function __toString();
}
