<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Condition
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
     * @param Bool  $onlyVaild
     * @return Array
     */
    public static function options($onlyVaild = false): array
    {
        $items = $onlyVaild ? [] : ['' => trans('php-core::system.null')];
        $types = self::all();
        foreach ($types as $key => $value) {
            $lang = trans('php-core::punctuation.parentheses.BLR', ['value' => trans('php-core::constants.condition.'.$key)]);
            $items = array_merge($items, [$key => $key.$lang]);
        }

        return $items;
    }

    /**
     * @return Array
     */
    public static function all(): array
    {
        return [
            '='      => 'A equals B',
            '!='     => 'A is not equal to B',
            '<'      => 'A is less than B',
            '<='     => 'A is less than or equals to B',
            '>'      => 'A is greater than B',
            '>='     => 'A is greater than or equals to B',
            'in'     => 'A is in B',
            'not in' => 'A is not in B',
            '&&'     => 'A AND B',
            '||'     => 'A OR B'
        ];
    }
}
