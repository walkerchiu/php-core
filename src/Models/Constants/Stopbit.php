<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Stopbit
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
            '1'   => '1',
            '1.5' => '1.5',
            '2'   => '2',
            '3'   => '3'
        ];
    }
}
