<?php

namespace WalkerChiu\Core\Models\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use WalkerChiu\Core\Models\Entities\UuidModel;

class LogSys extends UuidModel
{
    use SoftDeletes;

    protected $fillable = [
        'host_type', 'host_id',
        'morph_type', 'morph_id',
        'type',
        'summary', 'data',
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
        'is_highlighted' => 'boolean'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->table = config('wk-core.table.core.logs_sys');

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
}
