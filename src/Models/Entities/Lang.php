<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\UuidModel;

abstract class Lang extends UuidModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var Array
     */
    protected $fillable = [
        'morph_type', 'morph_id',
        'user_id',
        'code', 'key', 'value',
        'is_current'
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
        'is_current' => 'boolean'
    ];

    /**
     * Get the owning morph model.
     */
    public function morph()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('wk-core.class.user'), 'user_id', 'id');
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
     * @param String  $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }

    /**
     * @param $query
     * @param String  $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfKey($query, $key)
    {
        return $query->where('key', $key);
    }

    /**
     * @param $query
     * @param String  $code
     * @param String  $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCodeAndKey($query, $code, $key)
    {
        return $query->where('code', $code)
                     ->where('key', $key);
    }

    /**
     * @param $query
     * @param String  $code
     * @param String  $key
     * @param String  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMatch($query, $code, $key, $value)
    {
        return $query->where('code', $code)
                     ->where('key', $key)
                     ->where('value', $value);
    }
}
