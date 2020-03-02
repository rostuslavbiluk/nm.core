<?php

namespace Vendor\Traits\UserAccess;

use Bitrix\Main\{ArgumentException, Engine\CurrentUser, ObjectPropertyException, SystemException};
use Vendor\Exception\Iblock\IblockNotFoundException;
use Vendor\Exception\User\UserNotFoundException;

/**
 * Trait UserAccessTraitRest
 * @package Vendor\Traits\UserAccess
 */
trait UserAccessTraitRest
{
    /**
     * @var array
     */
    protected static $entityRights = [];
    /**
     * @var
     */
    protected static $entityLeaderIds;
    /**
     * @var
     */
    protected static $entityActivistIds;
    /**
     * @var
     */
    protected static $entityAuthorId;
    /**
     * @var
     */
    protected static $entityCurrentStatus;

    /**
     * @param int $entityId
     *
     * @return array
     */
    public static function getUserRights(int $entityId): array
    {
        $params = [];
        if ($entityId > 0) {
            $className = static::ENTITY;
            $entity = new $className($entityId);
            $params['AUTHOR_ID'] = $entity->getAuthorReal();
            $params['GROUP_ID'] = $entity->getGroupReal();
            $params['SCOPE_ID'] = $entity->getScopeReal();
            $params['STATUS'] = $entity->getStatus()->getXmlId();
        }
        return static::userHasRight($params);
    }

    /**
     * @param int $entityId
     *
     * @return array
     */
    public static function getUserRightsForNews(int $entityId): array
    {
        $params = [];
        if ($entityId > 0) {
            $className = static::ENTITY;
            $entity = new $className($entityId);
            $params['AUTHOR_ID'] = $entity->getAuthorReal();
            $params['GROUP_ID'] = $entity->getGroupReal();
            $params['SCOPE_ID'] = $entity->getScopeReal();
        }
        return static::userHasRight($params);
    }

    /**
     * @param array $accessList
     *
     * @return array
     */
    public static function primaryRight(array $accessList): array
    {
        if (!empty($accessList)) {
            if (defined('static::ACTIONS_PRIMARY_RIGHT')) {
                $actionPrimary = static::ACTIONS_PRIMARY_RIGHT;
                if (!empty($actionPrimary)) {
                    foreach ($actionPrimary as $primaryAction => $itemPrimary) {
                        $result = array_intersect($accessList, $itemPrimary);
                        if (!empty($result)) {
                            $accessList = array_diff($accessList, $itemPrimary);
                            $accessList[] = $primaryAction;
                        }
                    }
                    $accessList = array_values($accessList);
                }
            }
        }
        return $accessList;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    protected static function userHasRight(array $params): array
    {
        static::prepareParamsRoles($params);
        /** @var UserAccess $access */
        $access = UserAccess::getInstance();
        static::getAccessForLeader($access);
        static::getAccessForActivist($access);
        static::getAccessForAuthor($access);
        static::prepareActions($access);
        $access->setRights(static::primaryRight($access->getRightsReal()));
        return $access->getAccessFormatted();
    }

    /**
     * @param array $params
     */
    protected static function prepareParamsRoles(array $params): void
    {
        try {
            /** params with different sources AUTHOR */
            if (isset($params['AUTHOR_ID'])) {
                static::$entityAuthorId = (int)$params['AUTHOR_ID'];
            }
            /** params with different sources LEADER */
            if (isset($params['GROUP_ID']) && (int)$params['GROUP_ID'] > 0) {
                $userRoles = GroupRolesService::getUserRole((int)$params['GROUP_ID'], (int)CurrentUser::get()->getId());
                $currentUserRoles = array_intersect(array_column($userRoles, 'ROLE'), [UserGroupRoles::RESPONSIBLE_ROLE['LEADER']]);
                if (!empty($currentUserRoles)) {
                    static::$entityLeaderIds[] = (int)CurrentUser::get()->getId();
                }
                $currentUserRoles = array_intersect(array_column($userRoles, 'ROLE'), [UserGroupRoles::RESPONSIBLE_ROLE['ROOT_ACTIVIST']]);
                if (!empty($currentUserRoles)) {
                    static::$entityActivistIds[] = (int)CurrentUser::get()->getId();
                }
            }
            if (isset($params['SCOPE_ID']) && (int)$params['SCOPE_ID'] > 0) {
                static::$entityLeaderIds[] = (int)ScopeService::getScopeLeaderId($params['SCOPE_ID']);
            }
            if (!empty($params['STATUS'])) {
                static::$entityCurrentStatus = $params['STATUS'];
            }
        } catch (ArgumentException|SystemException $e) {
        } catch (IblockException|IblockNotFoundException|ObjectPropertyException $e) {
        } catch (UserNotFoundException $e) {
        }
    }

    /**
     * @param UserAccess $access
     */
    protected static function getAccessForLeader(UserAccess $access): void
    {
        if (!empty(static::$entityLeaderIds)) {
            static::$entityLeaderIds = array_unique(static::$entityLeaderIds);
            foreach (static::$entityLeaderIds as $leaderUserId) {
                $access->addCompareIds($leaderUserId);
            }
        }
        if ($access->getAccess()) {
            if (defined('static::ACCESS_ACTIONS_RESPONSIBLE')) {
                $buttonSwitch = static::ACCESS_ACTIONS_RESPONSIBLE;
                $actionUserAccess = [];
                if (!empty($buttonSwitch[static::$entityCurrentStatus])) {
                    $actionUserAccess = $buttonSwitch[static::$entityCurrentStatus];
                }
                $access->addRights($actionUserAccess);
            }
        }
    }

    /**
     * @param UserAccess $access
     */
    protected static function getAccessForActivist(UserAccess $access): void
    {
        if (!empty(static::$entityActivistIds)) {
            static::$entityLeaderIds = array_unique(static::$entityActivistIds);
            self::getAccessForLeader($access);
        }
    }

    /**
     * @param UserAccess $access
     */
    protected static function getAccessForAuthor(UserAccess $access): void
    {
        if (static::$entityAuthorId > 0) {
            $access->resetCompareIds();
            $access->addCompareIds(static::$entityAuthorId);
        }
        if ($access->getAccess()) {
            $actionUserAccess = [];
            if (defined('static::ACCESS_ACTIONS_AUTHOR')) {
                $buttonSwitch = static::ACCESS_ACTIONS_AUTHOR;
                if (!empty($buttonSwitch[static::$entityCurrentStatus])) {
                    $actionUserAccess = $buttonSwitch[static::$entityCurrentStatus];
                }
            }
            $defaultActions = [
                ActionBaseEnum::ACTIONS['ENTITY_DELETE'],
            ];
            if (defined('static::ACCESS_ACTIONS_AUTHOR_FORBIDDEN')) {
                $actionExclude = static::ACCESS_ACTIONS_AUTHOR_FORBIDDEN;
                if (!empty($actionExclude[static::$entityCurrentStatus])) {
                    $defaultActions = array_diff($defaultActions, $actionExclude[static::$entityCurrentStatus]);
                }
            }
            $accessActions = array_merge($defaultActions, $actionUserAccess);
            $access->addRights($accessActions);
        }
    }

    /**
     * @param UserAccess $access
     */
    protected static function prepareActions(UserAccess $access): void
    {
        $access->addRights(self::$entityRights);
    }
}