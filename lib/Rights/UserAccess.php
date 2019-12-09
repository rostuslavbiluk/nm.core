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
     * @return UserAccess|null
     */
    public function addCompareIds(int $id): ?UserAccess
    {
        $this->compareIds[] = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccess(): string
    {
        if (in_array($this->userId, $this->compareIds)) {
            return 'Y';
        }
        return 'N';
    }

    /**
     * @return $this
     */
    public function resetCompareIds(): self
    {
        $this->compareIds = [];
        return $this;
    }
}