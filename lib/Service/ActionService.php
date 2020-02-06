<?php

namespace Vendor\Service;

/**
 * Class ActionService
 * @package Vendor\Service
 */
class ActionService
{
    public static function checkActionCode($period)
    {
        if (!in_array($period, array_keys(StatisticEnum::PERIOD))) {
            throw new ArgumentException("неверный период");
        }
    }
}