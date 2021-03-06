<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\UuidModel;

abstract class UuidEntity extends UuidModel
{
    use SoftDeletes;

    protected $fillable = [
        'is_enabled'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $casts = [
        'is_enabled' => 'boolean'
    ];

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
