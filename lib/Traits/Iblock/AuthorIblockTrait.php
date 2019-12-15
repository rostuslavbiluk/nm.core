<?php

namespace Vendor\Traits\Iblock;

use Bitrix\Main\Engine\CurrentUser;
use Bitrix\Main\ArgumentException;
use Vendor\Exception\Iblock\IblockException;
use Vendor\Exception\Iblock\IblockNotFoundException;
use Vendor\Exception\Iblock\IblockPropertyNotFoundException;
use Vendor\Orm\Model\UserCustom;

/**
 * Trait AuthorIblockTrait
 * @package Vendor\Traits\Iblock
 */
trait AuthorIblockTrait
{
    /**
     * @return UserCustom|null
     */
    public function getAuthor(): ?UserCustom
    {
        $element = $this->getElement();
        if ($element->getCreatedByUser() === null && $element->getCreatedBy() > 0) {
            $element->fillCreatedByUser();
        }
        return $element->getCreatedByUser();
    }

    /**
     * @return array|string
     */
    public function getAuthorFormatted()
    {
        $user = $this->getAuthor();
        return $user === null ? '' : $this->getUserFields($user);
    }

    /**
     * @return int|null
     */
    public function getAuthorReal(): ?int
    {
        $user = $this->getAuthor();
        return $user === null ? null : $user->getId();
    }

    /**
     * @param UserCustom|null $user
     *
     * @return array|string
     */
    public function getUserFields(?UserCustom $user)
    {
        $id = false;
        $fullName = '';
        $shortName = '';
        if ($user === null) {
            $curUser = CurrentUser::get();
            $id = $curUser->getId();
            $fullName = $curUser->getFullName();
            $shortName = $curUser->getLastName() . ' ' . mb_substr($curUser->getFirstName(), 0, 1, LANG_CHARSET) . '.';
        } else {
            $author = $this->getAuthor();
            if ($author !== null) {
                $id = $author->getId();
                $fullName = $author->getFullName();
                $shortName = $author->getShortName();
            }
        }
        return ['ID' => $id, 'FULL_NAME' => $fullName, 'SHORT_NAME' => $shortName];
    }

}