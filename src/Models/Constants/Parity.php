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
    /**
     * @return Array
     */
    public static function getCodes(): array
    {
        $items = [];
        $types = self::all();
        foreach ($types as $code => $type) {
            array_push($items, $code);
        }

        return $items;
    }

    /**
     * @return Array
     */
    public static function all(): array
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
