<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use WalkerChiu\Core\Models\Entities\DateTrait;
use WalkerChiu\Core\Models\Entities\UuidTrait;

abstract class UuidModel extends Model
{
    use DateTrait;
    use UuidTrait;

    /**
     * The "type" of the primary key ID.
     *
     * @var String
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var Bool
     */
    public $incrementing = false;

    /**
     * Indicates if the primary key is UUID.
     *
     * @var Bool
     */
    protected $pkIsUuid = true;



    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating( function ($model) {
            if (
                $model->pkIsUuid
                && empty($model->{$model->getKeyName()})
            ) {
                $model->{$model->getKeyName()} = $model->generateUuid();
            }
        });
    }

    /**
     * @param String  $attr
     * @return Bool
     */
    protected static function hasAttribute(string $attr): bool
    {
        return array_key_exists($attr, static::attributes);
    }
}
