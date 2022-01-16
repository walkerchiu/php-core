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
            '1'   => '1',
            '1.5' => '1.5',
            '2'   => '2',
            '3'   => '3'
        ];
    }
}
