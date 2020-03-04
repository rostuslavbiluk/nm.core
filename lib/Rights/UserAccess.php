<?php

namespace Vendor\Rights;

use Bitrix\Main\Engine\CurrentUser;

/**
 * Class UserAccess
 * @package Vendor\Rights
 */
class UserAccess
{
    /**
     * @var
     */
    protected static $instance;
    /**
     * @var array
     */
    protected $compareIds = [];
    /**
     * @var int
     */
    protected $userId;

    /**
     * UserAccess constructor.
     * @param null $userId
     */
    function __construct($userId = null)
    {
        $this->userId = (int)$userId;
    }

    /**
     * @param null $userId
     *
     * @return UserAccess
     */
    public static function getInstance($userId = null): UserAccess
    {
        if ((int)$userId <= 0) {
            $userId = (int)CurrentUser::get()->getId();
        }
        if (!isset(self::$instance[$userId])) {
            self::$instance[$userId] = new static($userId);
        }
        return self::$instance[$userId];
    }

    /**
     * @param int $id
     *
     * @return UserAccess
     */
    public function addCompareIds(int $id): self
    {
        $this->compareIds[] = $id;
        return $this;
    }

    /**
     * @param array $typeRight
     *
     * @return UserAccess
     */
    public function addRights(array $typeRight): self
    {
        if (!empty($typeRight)) {
            foreach ($typeRight as $right) {
                if (!empty($right)) {
                    $this->rights[] = $right;
                }
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getRightsReal(): array
    {
        return array_values(array_unique($this->rights));
    }

    /**
     * @param array $rights
     *
     * @return $this
     */
    public function setRights(array $rights): self
    {
        $this->rights = $rights;
        return $this;
    }

    /**
     * @return $this
     */
    public function resetRights(): self
    {
        $this->rights = [];
        return $this;
    }

    /**
     * @return bool
     */
    public function getAccess(): bool
    {
        if (in_array($this->userId, $this->compareIds)) {
            return true;
        }
        return false;
    }

    /**
     * @return $this
     */
    public function resetCompareIds(): self
    {
        $this->compareIds = [];
        return $this;
    }

    /**
     * @return array
     */
    public function getAccessFormatted(): array
    {
        return [
            'ID'      => $this->userId,
            'ACTIONS' => array_values(array_unique($this->rights)),
        ];
    }
}