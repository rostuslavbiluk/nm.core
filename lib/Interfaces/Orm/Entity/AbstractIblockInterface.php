<?php /** @noinspection PhpUnused */

namespace Vendor\Interfaces\Orm\Entity;

use Bitrix\Main\Result;

/**
 * Class AbstractIblockInterface
 * @package Vendor\Interfaces\Orm\Entity
 * @method AbstractIblockInterface|static set(string $code, mixed $value)
 * @method AbstractIblockInterface|static add(string $code, mixed $value)
 * @method mixed get(string $code, bool $formatted = false)
 */
interface AbstractIblockInterface extends CreatedByIblockInterface, CreatedByIblockInterface, DateCreateIblockInterface
{
    /**
     * @param $id
     */
    public function createObject($id): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getElement();

    /**
     * @return array
     */
    public function getSingleProps(): array;

    /**
     * @param string $name
     *
     * @return AbstractIblockInterface
     */
    public function setName(string $name): AbstractIblockInterface;

    /**
     * @return Result
     */
    public function save(): Result;

    /**
     * @param array $fields
     *
     * @return AbstractIblockInterface
     */
    public function setData(array $fields): AbstractIblockInterface;

    /**
     * @return array
     */
    public function toArray(): array;
}