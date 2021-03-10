<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class DataType
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
            $lang = trans('php-core::punctuation.parentheses.BLR', ['value' => trans('php-core::constants.dataType.'.$key)]);
            $items = array_merge($items, [$key => $key.$lang]);
        }

        return $items;
    }

    public static function all()
    {
        return [
            'array'          => 'Array',
            'boolean'        => 'Boolean',
            'datetime'       => 'Datetime',
            'int'            => 'Integer',
            'int_positive'   => 'Integer (Positive)',
            'int_unsigned'   => 'Integer (Unsigned)',
            'float'          => 'Float',
            'float_positive' => 'Float (Positive)',
            'float_unsigned' => 'Float (Unsigned)',
            'json'           => 'JSON',
            'string'         => 'String',
            'xml'            => 'XML'
        ];
    }
}
