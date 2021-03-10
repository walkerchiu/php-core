<?php

namespace WalkerChiu\Core\Models\Repositories;

trait RepositoryHasHostTrait
{
    /*
    |--------------------------------------------------------------------------
    | For Langs
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array $data
     * @return Entity
     */
    public function createLangWithoutCheck($data)
    {
        $lang = $this->entity->lang();
        $this->entity_lang = new $lang();

        return $this->entity_lang->create($data);
    }

    /**
     * @param String  $language
     * @param Mixed   $entity
     * @param Int     $user_id
     * @param String  $items
     * @param String  $type: pair, value, id, object
     * @param Boolean $auto_fill
     * @return Entity
     */
    public function createLang(String $language, $entity, $user_id, Array $items, $type = 'pair', $auto_fill = true)
    {
        $output = [];
        $flag = false;

        foreach ($items as $key=>$item) {
            $lang = $entity->findLang($language, $key, 'entire');
            if ((!isset($lang) && ($item == "0" || !empty($item))) ||
                (isset($lang) && $lang->value != $item)) {
                $lang = $this->createLangWithoutCheck([
                    'morph_type' => get_class($entity),
                    'morph_id'   => $entity->id,
                    'user_id'    => $user_id,
                    'code'       => $language,
                    'key'        => $key,
                    'value'      => $item
                ]);
                $flag = true;
            }

            if (isset($lang) && ($auto_fill || $flag)) {
                if ($type == 'pair')       $output = array_merge($output, [$lang->key => $lang->value]);
                elseif ($type == 'value')  array_push($output, $lang->value);
                elseif ($type == 'id')     array_push($output, $lang->id);
                elseif ($type == 'object') array_push($output, $lang);
            }
        }

        return $output;
    }





    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Query
     */
    public function baseQueryForRepository($host_type, $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->entity->unless(empty($host_type) || empty($host_id), function ($query) use ($host_type) {
                                    return $query->whereHasMorph('host', $host_type);
                                })
                            ->when(!is_null($target) && in_array($target, $this->morphType), function ($query) use ($target, $target_is_enabled) {
                                return $query->whereHas($target, function($query) use ($target_is_enabled) {
                                    $query->unless(is_null($target_is_enabled), function ($query) use ($target_is_enabled) {
                                            return $query->when($target_is_enabled, function ($query) {
                                                return $query->ofEnabled();
                                            }, function ($query) {
                                                return $query->ofDisabled();
                                            });
                                        });
                                });
                              });
    }

    /*
    |--------------------------------------------------------------------------
    | Enable and Disable
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $column
     * @param String  $operate
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Query
     */
    public function whereToEnable($host_type, $host_id, $column, $operate, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->where($column, $operate, $value)
                    ->update(['is_enabled' => 1]);
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $column
     * @param String  $operate
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Query
     */
    public function whereToDisable($host_type, $host_id, $column, $operate, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->where($column, $operate, $value)
                    ->update(['is_enabled' => 0]);
    }

    /*
    |--------------------------------------------------------------------------
    | For Query List
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function ofNormal($host_type, $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function ofEnabled($host_type, $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->ofEnabled()
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function ofDisabled($host_type, $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->ofDisabled()
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function ofTrash($host_type, $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->onlyTrashed()
                    ->orderBy('deleted_at', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | For List
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $code
     * @param Array   $data
     * @param Int     $page
     * @param Int     $nums per page
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function listOnlyEnabled($host_type, $host_id, String $code, Array $data, $page = null, $nums = null, $target = null, $target_is_enabled = null)
    {
        return $this->list($host_type, $host_id, $code, $data, $page, $nums, true);
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $code
     * @param Array   $data
     * @param Int     $page
     * @param Int     $nums per page
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function listOnlyDisabled($host_type, $host_id, String $code, Array $data, $page = null, $nums = null, $target = null, $target_is_enabled = null)
    {
        return $this->list($host_type, $host_id, $code, $data, $page, $nums, false);
    }

    /*
    |--------------------------------------------------------------------------
    | For Auto Complete
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $code
     * @param Any     $value
     * @param Int     $count
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function autoCompleteNameOfEnabled($host_type, $host_id, String $code, $value, $count = 10, $target = null, $target_is_enabled = null)
    {
        $records = $this->entity->lang()::with('morph')
                                        ->ofCurrent()
                                        ->ofCodeAndKey($code, 'name')
                                        ->whereHasMorph('morph', $this->entity->morph_type, function($query) use ($host_type, $host_id) {
                                                $query->ofEnabled()
                                                      ->unless(empty($host_type) || empty($host_id), function ($query) use ($host_type, $host_id) {
                                                            return $query->whereHasMorph('host', $host_type, function($query) {
                                                                $query->ofEnabled();
                                                            });
                                                        });
                                           })
                                        ->where('value', 'LIKE', $value .'%')
                                        ->orderBy('updated_at', 'DESC')
                                        ->select('morph_type', 'morph_id', 'value')
                                        ->take($count)
                                        ->get();
        $list = [];
        foreach ($records as $record) {
            if (property_exists($record->morph, 'sku'))
                $list[] = [
                    'id'   => $record->morph->id,
                    'sku'  => $record->morph->sku,
                    'name' => $record->value
                ];
            else
                $list[] = [
                    'id'     => $record->morph->id,
                    'serial' => $record->morph->serial,
                    'name'   => $record->value
                ];
        }

        return $list;
    }

    /**
     * @param String  $host_type
     * @param Int     $host_id
     * @param String  $code
     * @param Any     $value
     * @param Int     $count
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Array
     */
    public function autoCompleteSerialOfEnabled($host_type, $host_id, String $code, $value, $count = 10, $target = null, $target_is_enabled = null)
    {
        $records = $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                        ->with(['langs' => function ($query) use ($code) {
                                $query->ofCurrent()
                                    ->ofCodeAndKey($code, 'name');
                            }])
                        ->ofEnabled()
                        ->where('serial', 'LIKE', $value .'%')
                        ->orderBy('updated_at', 'DESC')
                        ->select('id', 'serial')
                        ->take($count)
                        ->get();
        $list = [];
        foreach ($records as $record) {
            $list[] = [
                'id'     => $record->id,
                'serial' => $record->serial,
                'name'   => $record->findLangByKey('name')
            ];
        }

        return $list;
    }
}
