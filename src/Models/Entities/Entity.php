<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\DateTrait;

abstract class Entity extends Model
{
    use DateTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var Array
     */
    protected $fillable = [
        'is_enabled',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var Array
	 */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var Array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var Array
     */
    protected $casts = [
        'is_enabled' => 'boolean'
    ];



    /**
     * @param String  $attr
     * @return Bool
     */
    protected static function hasAttribute(string $attr): bool
    {
        return array_key_exists($attr, static::attributes);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfEnabled($query)
    {
        return $query->where('is_enabled', 1);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDisabled($query)
    {
        return $query->where('is_enabled', 0);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCurrent($query)
    {
        return $query->where('is_current', 1);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfPast($query)
    {
        return $query->where('is_current', 0);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfHighlighted($query)
    {
        return $query->where('is_highlighted', 1);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMain($query)
    {
        return $query->where('is_main', 1);
    }

    /**
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfBase($query)
    {
        return $query->where('is_base', 1);
    }
}
