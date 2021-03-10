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
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the primary key is UUID.
     *
     * @var bool
     */
    protected $pkIsUuid = true;



    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->pkIsUuid && empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = $model->generateUuid();
            }
        });
    }

    /**
     * @param $attr
     * @return Boolean
     */
    protected static function hasAttribute($attr)
    {
        return array_key_exists($attr, static::attributes);
    }
}
