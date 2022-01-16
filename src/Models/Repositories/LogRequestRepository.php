<?php

namespace WalkerChiu\Core\Models\Repositories;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Forms\FormHasHostTrait;
use WalkerChiu\Core\Models\Repositories\Repository;
use WalkerChiu\Core\Models\Repositories\RepositoryHasHostTrait;
use WalkerChiu\Core\Models\Services\PackagingFactory;

class LogRequestRepository extends Repository
{
    use FormHasHostTrait;
    use RepositoryHasHostTrait;

    protected $instance;



    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = App::make(config('wk-core.class.core.logRequest'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param Array   $data
     * @param Bool    $is_enabled
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @param Bool    $auto_packing
     * @return Array|Collection|Eloquent
     */
    public function list(?string $host_type, ?string $host_id, array $data, $is_enabled = null, $target = null, $target_is_enabled = null, $auto_packing = false)
    {
        if (
            empty($host_type)
            || empty($host_id)
        ) {
            $instance = $this->instance;
        } else {
            $instance = $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled);
        }
        if ($is_enabled === true)      $instance = $instance->ofEnabled();
        elseif ($is_enabled === false) $instance = $instance->ofDisabled();

        $data = array_map('trim', $data);
        $repository = $instance->when(
                                    config('wk-core.onoff.morph-tag')
                                    && !empty(config('wk-core.class.morph-tag.tag'))
                                , function ($query) {
                                    return $query->with(['tags', 'tags.langs']);
                                })
                                ->when($data, function ($query, $data) {
                                    return $query->unless(empty($data['id']), function ($query) use ($data) {
                                                return $query->where('id', $data['id']);
                                            })
                                            ->unless(empty($data['morph_type']), function ($query) use ($data) {
                                                return $query->where('morph_type', $data['morph_type']);
                                            })
                                            ->unless(empty($data['morph_id']), function ($query) use ($data) {
                                                return $query->where('morph_id', $data['morph_id']);
                                            })
                                            ->unless(isset($data['type']), function ($query) use ($data) {
                                                return $query->where('type', $data['type']);
                                            })
                                            ->unless(isset($data['action']), function ($query) use ($data) {
                                                return $query->where('action', $data['action']);
                                            })
                                            ->unless(isset($data['api']), function ($query) use ($data) {
                                                return $query->where('api', $data['api']);
                                            })
                                            ->unless(isset($data['status_code']), function ($query) use ($data) {
                                                return $query->where('status_code', $data['status_code']);
                                            })
                                            ->unless(isset($data['status_name']), function ($query) use ($data) {
                                                return $query->where('status_name', $data['status_name']);
                                            })
                                            ->unless(isset($data['state']), function ($query) use ($data) {
                                                return $query->where('state', $data['state']);
                                            })
                                            ->unless(isset($data['request']), function ($query) use ($data) {
                                                return $query->where('request', 'LIKE', $data['request']."%");
                                            })
                                            ->unless(isset($data['response']), function ($query) use ($data) {
                                                return $query->where('response', 'LIKE', $data['response']."%");
                                            })
                                            ->unless(isset($data['header']), function ($query) use ($data) {
                                                return $query->where('header', 'LIKE', $data['header']."%");
                                            })
                                            ->unless(empty($data['categories']), function ($query) use ($data) {
                                                return $query->whereHas('categories', function ($query) use ($data) {
                                                    $query->ofEnabled()
                                                        ->whereIn('id', $data['categories']);
                                                });
                                            })
                                            ->unless(empty($data['tags']), function ($query) use ($data) {
                                                return $query->whereHas('tags', function ($query) use ($data) {
                                                    $query->ofEnabled()
                                                        ->whereIn('id', $data['tags']);
                                                });
                                            })
                                            ->unless(
                                                empty($data['orderBy'])
                                                || empty($data['orderType'])
                                            , function ($query) use ($data) {
                                                return $query->orderBy($data['orderBy'], $data['orderType']);
                                            });
                                }, function ($query) {
                                    return $query->orderBy('updated_at', 'DESC');
                                });

        if ($auto_packing) {
            $factory = new PackagingFactory(config('wk-core.output_format'), config('wk-core.pagination.pageName'), config('wk-core.pagination.perPage'));
            return $factory->output($repository);
        }

        return $repository;
    }

    /**
     * @param LogRequest  $instance
     * @return Array
     */
    public function show($instance): array
    {
    }
}
