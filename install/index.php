<?php

use Bitrix\Main\ModuleManager;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();


class nm_core extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'nm.core';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2019-12-09 23:15:14';
        $this->MODULE_NAME = 'Модуль с расширением функционала';
        $this->MODULE_DESCRIPTION = 'Модуль содержит вспомогательные классы и модели';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = '';
        $this->PARTNER_URI = '';
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function doUninstall()
    {
        ModuleManager::unregisterModule($this->MODULE_ID);
    }
}