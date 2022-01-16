<?php

namespace WalkerChiu\Core\Models\Entities\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class BinaryIp implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param String  $key
     * @param Mixed   $value
     * @param Array   $attributes
     * @return Array
     */
    public function get($model, $key, $value, $attributes)
    {
        return inet_ntop($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model  $model
     * @param String  $key
     * @param Array   $value
     * @param Array   $attributes
     * @return String
     */
    public function set($model, $key, $value, $attributes)
    {
        return inet_pton($value);
    }
}