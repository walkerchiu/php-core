<?php

namespace WalkerChiu\Core\Models\Services;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Services\ClientIpTrait;

class LogSearchService
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
        $this->repository = App::make(config('wk-core.class.core.logSearchRepository'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $morph_type
     * @param String  $morph_id
     * @param String  $user_id
     * @param String  $keyword
     * @param Array   $data
     * @return LogSearch
     */
    public function save(?string $host_type, ?string $host_id, ?string $morph_type, ?string $morph_id, ?string $user_id, ?string $keyword, array $data)
    {
        return $this->repository->save([
            'host_type'  => $host_type,
            'host_id'    => $host_id,
            'morph_type' => $morph_type,
            'morph_id'   => $morph_id,
            'user_id'    => $user_id,
            'keyword'    => $keyword,
            'data'       => $data,
            'ip'         => $this->getClientIp()
        ]);
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param Array   $data
     * @param Int     $days
     * @param Bool    $groupByUser
     * @param Bool    $groupByValue
     * @param Int     $count
     * @return Array
     */
    public function listKeywords($host_type = null, $host_id = null, $data = [], $days = null, $groupByUser = true, $groupByValue = true, $count = 10)
    {
        $records = $this->repository->listKeywords($host_type, $host_id, $data, $days);

        $list = [];
        if ($groupByUser) {
            $list_gu = [];
            foreach ($records as $record) {
                if (is_null($record->user_id)) {
                    array_push($list_gu, [$record->keyword, $record->ip]);
                } else {
                    array_push($list_gu, [$record->keyword, $record->user_id]);
                }
            }
            array_unique($list_gu, SORT_REGULAR);

            if ($groupByValue) {
                $list_gv = [];
                foreach ($list_gu as $item) {
                    if (in_array($item[0], $list_gv))
                        $list_gv[$item[0]] += 1;
                    else
                        $list_gv[$item[0]] = 1;
                }

                arsort($list_gv);
                foreach ($list_gv as $key => $value) {
                    array_push($list, $key);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            } else {
                foreach ($list_gu as $item) {
                    array_push($list, $item[0]);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            }
        } else {
            if ($groupByValue) {
                $list_gv = [];
                foreach ($records as $record) {
                    if (in_array($record->keyword, $list_gv))
                        $list_gv[$record->keyword] += 1;
                    else
                        $list_gv[$record->keyword] = 1;
                }

                arsort($list_gv);
                foreach ($list_gv as $key => $value) {
                    array_push($list, $key);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            } else {
                foreach ($records as $record) {
                    array_push($list, $record->keyword);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            }
        }

        return $list;
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param Array   $data
     * @param Int     $days
     * @param Bool    $groupByUser
     * @param Bool    $groupByValue
     * @param Int     $count
     * @return Array
     */
    public function listData($host_type = null, $host_id = null, $data = [], $days = null, $groupByUser = true, $groupByValue = true, $count = 10)
    {
        $records = $this->repository->listData($host_type, $host_id, $data, $days);

        $list = [];
        if ($groupByUser) {
            $list_gu = [];
            foreach ($records as $record) {
                if (is_null($record->user_id)) {
                    array_push($list_gu, [$record->data, $record->ip]);
                } else {
                    array_push($list_gu, [$record->data, $record->user_id]);
                }
            }
            array_unique($list_gu, SORT_REGULAR);

            if ($groupByValue) {
                $list_gv = [];
                foreach ($list_gu as $item) {
                    if (in_array($item[0], $list_gv))
                        $list_gv[json_encode($item[0])] += 1;
                    else
                        $list_gv[json_encode($item[0])] = 1;
                }

                arsort($list_gv);
                foreach ($list_gv as $key => $value) {
                    array_push($list, json_decode($key));
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            } else {
                foreach ($list_gu as $item) {
                    array_push($list, $item[0]);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            }
        } else {
            if ($groupByValue) {
                $list_gv = [];
                foreach ($records as $record) {
                    if (in_array($record->data, $list_gv))
                        $list_gv[json_encode($record->data)] += 1;
                    else
                        $list_gv[json_encode($record->data)] = 1;
                }

                arsort($list_gv);
                foreach ($list_gv as $key => $value) {
                    array_push($list, json_decode($key));
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            } else {
                foreach ($records as $record) {
                    array_push($list, $record->data);
                    if (
                        is_integer($count)
                        && count($list) == $count
                    ) {
                        break;
                    }
                }
            }
        }

        return $list;
    }
}
