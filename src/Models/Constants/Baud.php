<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Baud
{
    public static function getCodes()
    {
        $items = [];
        $types = self::all();
        foreach ($types as $code=>$type) {
            array_push($items, $code);
        }

        return $items;
    }

    public static function all()
    {
        return [
            '9600'   => '9600',
            '19200'  => '19200',
            '38400'  => '38400',
            '57600'  => '57600',
            '115200' => '115200'
        ];
    }
}
