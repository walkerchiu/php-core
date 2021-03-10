<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Parity
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
            'None'  => 'None',
            'Odd'   => 'Odd',
            'Even'  => 'Even',
            'Mark'  => 'Mark',
            'Space' => 'Space'
        ];
    }
}
