<?php


namespace Vendor\Traits\Rest\Action;


use Bitrix\Main\ArgumentException;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Vendor\Exception\Iblock\ElementNotFoundException;
use Rakit\Validation\Validator;

/**
 * Trait RemoveItemTraitRest
 * @package Vendor\Traits\Iblock
 */
trait RemoveItemTraitRest
{

    /**
     * @param array $params
     *
     * @return array
     * @throws RestCriticalException
     * @throws RestFatalSaveException
     * @throws RestValidateException
     */
    public static function removeItem(array $params): array
    {
        $result = ['status' => false];
        $params = array_change_key_case($params, CASE_UPPER);
        $validator = new Validator();
        $rules = [
            'ID' => 'required|integer|min:1',
        ];
        static::validate($validator, $params, $rules);
        $id = (int)$params['ID'];
        try {
            $className = static::ENTITY;
            $entity = new $className($id);
            $res = $entity->removeItem();
            if (!$res->isSuccess()) {
                throw new RestFatalSaveException(BitrixUtils::extractErrorMessage($res));
            }
            $result = ['status' => true, 'id' => $entity->getId(), 'redirect_url' => $entity->getListUrl()];
        } catch (ObjectPropertyException|ArgumentException|SystemException $e) {
            throw new RestCriticalException($e->getMessage());
        } catch (ElementNotFoundException|IblockException|IblockNotFoundException $e) {
            throw new RestCriticalException($e->getMessage());
        }
        return $result;
    }
}