<?php /** @noinspection PhpUnused */

namespace Vendor\Orm\Tables\Iblock;

use Bitrix\Main\SystemException;
use Bitrix\Main\ArgumentException;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Query;
use Vendor\Exception\Iblock\IblockException;
use Vendor\Exception\Iblock\IblockNotFoundException;
use Vendor\Orm\Tables\BaseDataManagerTable;
use Vendor\Orm\Tables\UserCustomBaseTable;

/**
 * Class SectionCustomTable
 * @package Vendor\Orm\Tables\Iblock
 */
class SectionCustomTable extends SectionTable
{
    public const IBLOCK_TYPE = '';
    public const IBLOCK_CODE = '';

    /**
     * @return array
     * @throws ArgumentException
     * @throws SystemException
     */
    public static function getMap()
    {
        $map = parent::getMap();
        $map['CREATED_BY_USER'] = new Reference('CREATED_BY_USER', UserCustomBaseTable::class, ['=this.CREATED_BY' => 'ref.ID'],
            ['join_type' => 'LEFT']);
        $map['MODIFIED_BY_USER'] = new Reference('MODIFIED_BY_USER', UserCustomBaseTable::class, ['=this.MODIFIED_BY' => 'ref.ID'],
            ['join_type' => 'LEFT']);
        return $map;
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

    /**
     * @return string|null
     * @throws ArgumentException
     * @throws IblockNotFoundException
     * @throws IblockException
     */
    public static function getUfId()
    {
        $iblockId = static::getIblockId();
        return 'IBLOCK_' . $iblockId . '_SECTION';
    }

    /**
     * @return int
     * @throws ArgumentException
     * @throws IblockNotFoundException
     * @throws IblockException
     */
    public static function getIblockId(): int
    {
        if (!empty(static::IBLOCK_TYPE) && !empty(static::IBLOCK_CODE)) {
            try {
                $iblockInfo = IblockTable::query()
                    ->setSelect(['*'])
                    ->where('CODE', static::IBLOCK_CODE)
                    ->where('IBLOCK_TYPE_ID', static::IBLOCK_TYPE)
                    ->fetch();
                if ((int)$iblockInfo['ID'] > 0) {
                    return $iblockInfo['ID'];
                }
            } catch (ArgumentException|SystemException $e) {
                throw new IblockException($e->getMessage());
            }
        }
        return 0;
    }

    /**
     * @return Query
     * @throws ArgumentException
     * @throws IblockException
     * @throws IblockNotFoundException
     * @throws SystemException
     */
    public static function query()
    {
        $query = new Query(static::getEntity());
        if (static::getIblockId() > 0) {
            $query->where('IBLOCK_ID', static::getIblockId());
        }
        return $query;
    }
}