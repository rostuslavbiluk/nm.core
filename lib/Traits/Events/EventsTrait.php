<?php

namespace Vendor\Traits\Events;

use Bitrix\Main\Event;
use Bitrix\Main\Result;

trait EventsTrait
{
    /**
     * @param Result $result
     */
    protected function onAfterSave(Result $result): void
    {
        $event = new Event('module.name', 'onAfterMethodSave');
        $event->setParameter('ID', 1);
        $event->send();
    }

    /**
     * @param Result $result
     */
    protected function onBeforeSave(Result $result): void
    {
        $event = new Event('module.name', 'onBeforeMethodSave');
        $event->setParameter('ID', 1);
        $event->send();
    }
}