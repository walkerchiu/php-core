<?php

namespace WalkerChiu\Core\Models\Repositories;

use Illuminate\Support\Facades\App;
use WalkerChiu\Core\Models\Forms\FormHasHostTrait;
use WalkerChiu\Core\Models\Repositories\Repository;
use WalkerChiu\Core\Models\Repositories\RepositoryHasHostTrait;

class LogSysRepository extends Repository
{
    use FormHasHostTrait;
    use RepositoryHasHostTrait;

    protected $entity;

    public function __construct()
    {
        $this->entity = App::make(config('wk-core.class.core.logSys'));
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $code
     * @param Array   $data
     * @param Int     $page
     * @param Int     $nums per page
     * @param Boolean $is_enabled
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function list($host_type, $host_id, String $code, Array $data, $page = null, $nums = null, $is_enabled = null, $target = null, $target_is_enabled = null)
    {
        $this->assertForPagination($page, $nums);

        if (empty($host_type) || empty($host_id)) {
            $entity = $this->entity;
        } else {
            $entity = $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled);
        }
        if ($is_enabled === true)      $entity = $entity->ofEnabled();
        elseif ($is_enabled === false) $entity = $entity->ofDisabled();

        $data = array_map('trim', $data);
        $records = $entity->when( config('wk-core.onoff.morph-tag') && !empty(config('wk-core.class.morph-tag.tag')), function ($query) {
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
                                      ->unless(isset($data['summary']), function ($query) use ($data) {
                                          return $query->where('summary', 'LIKE', $data['summary']."%");
                                      })
                                      ->unless(isset($data['data']), function ($query) use ($data) {
                                          return $query->where('data', 'LIKE', $data['data']."%");
                                      })
                                      ->when(isset($data['is_highlighted']), function ($query) use ($data) {
                                          return $query->where('is_highlighted', $data['is_highlighted']);
                                      })
                                      ->unless(empty($data['categories']), function ($query) use ($data) {
                                          return $query->whereHas('categories', function($query) use ($data) {
                                              $query->ofEnabled()
                                                    ->whereIn('id', $data['categories']);
                                          });
                                      })
                                      ->unless(empty($data['tags']), function ($query) use ($data) {
                                          return $query->whereHas('tags', function($query) use ($data) {
                                              $query->ofEnabled()
                                                    ->whereIn('id', $data['tags']);
                                          });
                                      })
                                      ->unless(!empty($data['orderBy']) && !empty($data['orderType']), function ($query) use ($data) {
                                            return $query->orderBy($data['orderBy'], $data['orderType']);
                                        }, function ($query) {
                                            return $query->orderBy('updated_at', 'DESC');
                                        });
                            }, function ($query) {
                                return $query->orderBy('updated_at', 'DESC');
                            })
                          ->get()
                          ->when(is_integer($page) && is_integer($nums), function ($query) use ($page, $nums) {
                              return $query->forPage($page, $nums);
                          });
        $list = [];
        foreach ($records as $record) {
            $data = $record->toArray();
            array_push($list,
                array_merge($data, [
                    'id'             => $record->id,
                    'type'           => $record->type,
                    'summary'        => $record->summary,
                    'data'           => $record->data,
                    'is_highlighted' => $record->is_highlighted
                ])
            );
        }

        return $list;
    }

    /**
     * @param LogSys $entity
     * @param Array|String $code
     * @return Array
     */
    public function show($entity, $code)
    {
    }
}
