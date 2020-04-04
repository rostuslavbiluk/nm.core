<?php /** @noinspection PhpUnused */

namespace Vendor\Orm\Tables\Iblock;

use Bitrix\Iblock\SectionElementTable;
use Vendor\Orm\Tables\BaseDataManagerTable;

/**
 * Class SectionElementCustomTable
 * @package Vendor\Orm\Tables\Iblock
 */
class SectionElementCustomTable extends SectionElementTable
{

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