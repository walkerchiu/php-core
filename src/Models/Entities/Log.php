<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\Casts\BinaryIp;
use WalkerChiu\Core\Models\Entities\UuidModel;

class Log extends UuidModel
{
    use SoftDeletes;

    protected $fillable = [
        'host_type', 'host_id',
        'morph_type', 'morph_id',
        'type',
        'user_id',
        'summary', 'data',
        'header', 'ip',
        'is_highlighted'
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
        'summary'        => 'json',
        'data'           => 'json',
        'header'         => 'json',
        'ip'             => BinaryIp::class,
        'is_highlighted' => 'boolean'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->table = config('wk-core.table.core.logs');

        parent::__construct($attributes);
    }

    /**
     * Get the owning host model.
     */
    public function host()
    {
        return $this->morphTo();
    }

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
}
