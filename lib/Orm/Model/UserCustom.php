<?php

namespace Vendor\Orm\Model;

use Vendor\Interfaces\Orm\Model\UserInterface;

class UserCustom implements UserInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return 0;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getNameFirstLetter(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getBirthdayReal(): string
    {
        return '';
    }

    /**
     * @return array
     */
    public function getBirthdayFormatted(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getPersonalPhotoSrc(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getEditUrl(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getProfileUrl(): string
    {
        return '';
    }
}