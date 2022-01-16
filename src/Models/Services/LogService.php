<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Services\ClientIpTrait;

class LogService
{
    use ClientIpTrait;

    protected $repository;



    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = App::make(config('wk-core.class.core.logRepository'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $morph_type
     * @param String  $morph_id
     * @param String  $type
     * @param String  $user_id
     * @param Array   $summary
     * @param Array   $data
     * @param Array   $header
     * @param Bool    $is_highlighted
     * @return Log
     */
    public function save(?string $host_type, ?string $host_id, ?string $morph_type, ?string $morph_id, ?string $type, ?string $user_id, ?array $summary, array $data, array $header, $is_highlighted = 0)
    {
        return $this->repository->save([
            'host_type'      => $host_type,
            'host_id'        => $host_id,
            'morph_type'     => $morph_type,
            'morph_id'       => $morph_id,
            'type'           => $type,
            'user_id'        => $user_id,
            'summary'        => $summary,
            'data'           => $data,
            'header'         => $header,
            'is_highlighted' => $is_highlighted,
            'ip'             => $this->getClientIp()
        ]);
    }
}
