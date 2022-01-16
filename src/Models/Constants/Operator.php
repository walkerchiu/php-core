<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Operator
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
            $lang = trans('php-core::punctuation.parentheses.BLR', ['value' => trans('php-core::constants.operator.'.$key)]);
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
            '='       => 'Assign',
            '+='      => 'Sum and Assign',
            '-='      => 'Subtract and Assign',
            '*='      => 'Multiply and Assign',
            '/='      => 'Divide and Assign',
            'after'   => 'After',
            'append'  => 'Append',
            'before'  => 'Before',
            'prepend' => 'Prepend'
        ];
    }
}
