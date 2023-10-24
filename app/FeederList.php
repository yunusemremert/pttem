<?php

namespace PtteM;

class FeederList
{
    public static array $feeders = [
        'facebook',
        'google',
        'cimri'
    ];

    public static function isFeederValid(string $feeder): bool
    {
        return in_array($feeder, self::$feeders);
    }
}