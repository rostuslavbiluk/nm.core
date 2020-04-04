<?php /** @noinspection PhpUnused */

namespace Vendor\Orm\Tables;

use Bitrix\Main\UserTable;
use Vendor\Orm\Model\UserBase;

/**
 * Class UserCustomBaseTable
 * @package Vendor\Orm\Tables
 */
class UserCustomBaseTable extends UserTable
{

    /**
     * @inheritDoc
     */
    public static function getObjectClass()
    {
        return UserBase::class;
    }

    public static function getCollectionClass()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public static function add(array $data)
    {
        BaseDataManagerTable::init(static::class);
        return BaseDataManagerTable::add($data);
    }

    /**
     * @inheritDoc
     */
    public static function update($primary, array $data)
    {
        BaseDataManagerTable::init(static::class);
        return BaseDataManagerTable::update($primary, $data);
    }

    /**
     * @inheritDoc
     */
    public static function delete($primary)
    {
        BaseDataManagerTable::init(static::class);
        return BaseDataManagerTable::delete($primary);
    }
}