<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\App;

class LogSysService
{
    protected $repository;



    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = App::make(config('wk-core.class.core.logSysRepository'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $morph_type
     * @param String  $morph_id
     * @param String  $type
     * @param Array   $summary
     * @param Array   $data
     * @param Bool    $is_highlighted
     * @return LogSys
     */
    public function save(?string $host_type, ?string $host_id, ?string $morph_type, ?string $morph_id, ?string $type, ?array $summary, array $data, $is_highlighted = 0)
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
