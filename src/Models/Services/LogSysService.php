<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\App;

class LogSysService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = App::make(config('wk-core.class.core.logSysRepository'));
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $morph_type
     * @param Int     $morph_id
     * @param String  $type
     * @param Array   $summary
     * @param Array   $data
     * @param Boolean $is_highlighted
     * @return LogSys
     */
    public function save($host_type, $host_id, $morph_type, $morph_id, $type, $summary, $data, $is_highlighted = 0)
    {
        return $this->repository->save([
            'host_type'      => $host_type,
            'host_id'        => $host_id,
            'morph_type'     => $morph_type,
            'morph_id'       => $morph_id,
            'type'           => $type,
            'summary'        => $summary,
            'data'           => $data,
            'is_highlighted' => $is_highlighted
        ]);
    }
}
