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
    public static function getCodes()
    {
        $items = [];
        $types = self::all();
        foreach ($types as $code=>$type) {
            array_push($items, $code);
        }

        return $items;
    }

    /**
     * 
     *
     * @param Boolean $only_vaild
     * @return Array
     */
    public static function options($only_vaild = false)
    {
        $items = $only_vaild ? [] : ['' => trans('php-core::system.null')];
        $types = self::all();
        foreach ($types as $key=>$value) {
            $lang = trans('php-core::punctuation.parentheses.BLR', ['value' => trans('php-core::constants.condition.'.$key)]);
            $items = array_merge($items, [$key => $key.$lang]);
        }

        return $items;
    }

    public static function all()
    {
        return [
            '='  => 'A equals B',
            '!=' => 'A is not equal to B',
            '<'  => 'A is less than B',
            '<=' => 'A is less than or equals to B',
            '>'  => 'A is greater than B',
            '>=' => 'A is greater than or equals to B',
            'in'     => 'A is in B',
            'not in' => 'A is not in B',
            '&&'     => 'A AND B',
            '||'     => 'A OR B'
        ];
    }
}
