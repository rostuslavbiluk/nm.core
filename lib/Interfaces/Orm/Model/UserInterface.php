<?php

namespace Vendor\Interfaces\Orm\Model;

/**
 * Class UserInterface
 * @package Vendor\Interfaces\Orm\Model
 */
interface UserInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @return string
     */
    public function getShortName(): string;

    /**
     * @return string
     */
    public function getNameFirstLetter(): string;

    /**
     * @return string
     */
    public function getBirthdayReal(): string;

    /**
     * @return array
     */
    public function getBirthdayFormatted(): array;

    /**
     * @return string
     */
    public function getPersonalPhotoSrc(): string;

    /**
     * @return string
     */
    public function getEditUrl(): string;

    /**
     * @return string
     */
    public function getProfileUrl(): string;
}