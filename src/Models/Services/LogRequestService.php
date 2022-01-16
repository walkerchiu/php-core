<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Services\ClientIpTrait;

class LogRequestService
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
        $this->repository = App::make(config('wk-core.class.core.logRequestRepository'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $morph_type
     * @param String  $morph_id
     * @param String  $type
     * @param String  $action
     * @param String  $api
     * @param String  $status_code
     * @param String  $status_name
     * @param String  $state
     * @param Array   $request
     * @param Array   $response
     * @param Array   $header
     * @return Log
     */
    public function save(?string $host_type, ?string $host_id, ?string $morph_type, ?string $morph_id, ?string $type, string $action, string $api, ?string $status_code, ?string $status_name, ?string $state, ?array $request, ?array $response, array $header)
    {
        return $this->repository->save([
            'host_type'   => $host_type,
            'host_id'     => $host_id,
            'morph_type'  => $morph_type,
            'morph_id'    => $morph_id,
            'type'        => $type,
            'action'      => $action,
            'api'         => $api,
            'status_code' => $status_code,
            'status_name' => $status_name,
            'state'       => $state,
            'request'     => $request,
            'response'    => $response,
            'header'      => $header,
            'ip'          => $this->getClientIp()
        ]);
    }
}
