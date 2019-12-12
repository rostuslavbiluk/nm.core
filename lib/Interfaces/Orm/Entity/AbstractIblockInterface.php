<?php /** @noinspection PhpUnused */

namespace Vendor\Interfaces\Orm\Entity;

use Bitrix\Main\Result;
use Bitrix\Main\Type\DateTime;
use Vendor\Orm\Model\UserCustom;

/**
 * Class AbstractIblockInterface
 * @package Vendor\Interfaces\Orm\Entity
 * @method AbstractIblockInterface|static set(string $code, mixed $value)
 * @method AbstractIblockInterface|static add(string $code, mixed $value)
 * @method mixed get(string $code, bool $formatted = false)
 */
interface AbstractIblockInterface
{
    /**
     * @return array
     */
    public function getSingleProps(): array;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return UserCustom|null
     */
    public function getCreatedBy(): ?UserCustom;

    /**
     * @return int|null
     */
    public function getCreatedByReal(): ?int;

    /**
     * @return DateTime
     */
    public function getDateCreate(): DateTime;

    /**
     * @return int
     */
    public function getDateCreateReal(): int;

    /**
     * @return string
     */
    public function getName(): string;

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
     * @return mixed
     */
    public function getElement();

    /**
     * @param array $fields
     *
     * @return AbstractIblockInterface
     */
    public function setData(array $fields): AbstractIblockInterface;

    /**
     * @param $id
     */
    public function createObject($id): void;

    /**
     * @return array
     */
    public function toArray(): array;
}