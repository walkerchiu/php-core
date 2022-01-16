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
     * @param Array  $data
     * @return Entity
     */
    public function createLangWithoutCheck(array $data)
    {
        $lang = $this->instance->lang();
        $this->instance_lang = new $lang();

        return $this->instance_lang->create($data);
    }

    /**
     * @param String  $language
     * @param Mixed   $instance
     * @param String  $user_id
     * @param String  $items
     * @param String  $type: pair, value, id, object
     * @param Bool    $auto_fill
     * @return Array
     */
    public function createLang(string $language, $instance, ?string $user_id, array $items, $type = 'pair', $auto_fill = true): array
    {
        $output = [];
        $flag = false;

        foreach ($items as $key => $item) {
            $lang = $instance->findLang($language, $key, 'entire');
            if (
                (
                    !isset($lang)
                    && (
                        $item == "0"
                        || !empty($item)
                    )
                )
                || (
                    isset($lang)
                    && $lang->value != $item
                )
            ) {
                $lang = $this->createLangWithoutCheck([
                    'morph_type' => get_class($instance),
                    'morph_id'   => $instance->id,
                    'user_id'    => $user_id,
                    'code'       => $language,
                    'key'        => $key,
                    'value'      => $item
                ]);
                $flag = true;
            }

            if (
                isset($lang)
                && (
                    $auto_fill
                    || $flag
                )
            ) {
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
     * @param String  $host_id
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Eloquent
     */
    public function baseQueryForRepository(?string $host_type, ?string $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->instance->unless(
                                    empty($host_type)
                                    || empty($host_id)
                                , function ($query) use ($host_type) {
                                        return $query->whereHasMorph('host', $host_type);
                                    })
                                ->when(
                                    !is_null($target)
                                    && isset($this->morphType)
                                    && is_array($this->morphType)
                                    && in_array($target, $this->morphType)
                                , function ($query) use ($target, $target_is_enabled) {
                                    return $query->whereHas($target, function ($query) use ($target_is_enabled) {
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
     * @param String  $host_id
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Entity
     */
    public function whereToEnable(?string $host_type, ?string $host_id, ?string $column, ?string $operate, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->where($column, $operate, $value)
                    ->update(['is_enabled' => 1]);
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Entity
     */
    public function whereToDisable(?string $host_type, ?string $host_id, ?string $column, ?string $operate, $value, $target = null, $target_is_enabled = null)
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
     * @param String  $host_id
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Eloquent
     */
    public function ofNormal(?string $host_type, ?string $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Eloquent
     */
    public function ofEnabled(?string $host_type, ?string $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->ofEnabled()
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Eloquent
     */
    public function ofDisabled(?string $host_type, ?string $host_id, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                    ->ofDisabled()
                    ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Eloquent
     */
    public function ofTrash(?string $host_type, ?string $host_id, $target = null, $target_is_enabled = null)
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
     * @param String  $host_id
     * @param String  $code
     * @param Array   $data
     * @param String  $is_enabled
     * @param Bool    $auto_packing
     * @return Array|Collection|Eloquent
     */
    public function listOnlyEnabled(?string $host_type, ?string $host_id, string $code, array $data, $auto_packing = false)
    {
        return $this->list(
            $host_type    = $host_type,
            $host_id      = $host_id,
            $code         = $code,
            $data         = $data,
            $is_enabled   = true,
            $auto_packing = $auto_packing
        );
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $code
     * @param Array   $data
     * @param Bool    $auto_packing
     * @return Array|Collection|Eloquent
     */
    public function listOnlyDisabled(?string $host_type, ?string $host_id, string $code, array $data, $auto_packing = false)
    {
        return $this->list(
            $host_type    = $host_type,
            $host_id      = $host_id,
            $code         = $code,
            $data         = $data,
            $is_enabled   = false,
            $auto_packing = $auto_packing
        );
    }

    /*
    |--------------------------------------------------------------------------
    | For Auto Complete
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $code
     * @param Mixed   $value
     * @param Int     $count
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Array
     */
    public function autoCompleteNameOfEnabled(?string $host_type, ?string $host_id, string $code, $value, $count = 10, $target = null, $target_is_enabled = null): array
    {
        $records = $this->instance->lang()::with('morph')
                                            ->ofCurrent()
                                            ->ofCodeAndKey($code, 'name')
                                            ->whereHasMorph('morph', get_class($this->instance), function ($query) use ($host_type, $host_id) {
                                                    $query->ofEnabled()
                                                        ->unless(
                                                                empty($host_type)
                                                                || empty($host_id)
                                                            , function ($query) use ($host_type, $host_id) {
                                                                return $query->whereHasMorph('host', $host_type, function ($query) {
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
     * @param String  $host_id
     * @param String  $code
     * @param Mixed   $value
     * @param Int     $count
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Array
     */
    public function autoCompleteSerialOfEnabled(?string $host_type, ?string $host_id, string $code, $value, $count = 10, $target = null, $target_is_enabled = null): array
    {
        $records = $this->baseQueryForRepository($host_type, $host_id, $target, $target_is_enabled)
                        ->with(['langs' => function ($query) use ($code) {
                                $query->ofCurrent()
                                      ->ofCodeAndKey($code, 'name');
                            }])
                        ->whereHas('langs', function ($query) use ($code) {
                            return $query->ofCurrent()
                                         ->ofCode($code);
                            })
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
