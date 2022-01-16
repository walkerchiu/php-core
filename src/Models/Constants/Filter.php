<?php

namespace WalkerChiu\Core\Models\Constants;

/**
 * @license MIT
 * @package WalkerChiu\Core
 *
 * 
 */

class Filter
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
            $lang = trans('php-core::punctuation.parentheses.BLR', ['value' => trans('php-core::constants.filter.'.$value[1], ['value' => $value[0]])]);
            $items = array_merge($items, [$key => $key.$lang]);
        }

        return $items;
    }

    /**
     * @return Array
     */
    public static function all(): array
    {
        $list = ['*' => ['', '*', 'Every one']];
        for ($i=1; $i<=10; $i++) {
            $list = array_merge($list, [
                $i.',/'  => [$i, '/',  'Only first '.$i],
                $i.',/+' => [$i, '/+', 'Every '.$i.' intervals'],
                $i.',/~' => [$i, '/~', 'Every greater than '.$i],
                $i.',~/' => [$i, '~/', 'Every less than '.$i]
            ]);
        }

        return $list;
    }
}
