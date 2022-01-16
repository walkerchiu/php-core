<?php

namespace WalkerChiu\Core\Models\Repositories;

trait RepositoryTrait
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

    /*
    |--------------------------------------------------------------------------
    | Enable and Disable
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @return Entity
     */
    public function whereToEnable(string $column, string $operate, $value)
    {
        return $this->instance->where($column, $operate, $value)
                              ->update(['is_enabled' => 1]);
    }

    /**
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @return Entity
     */
    public function whereToDisable(string $column, string $operate, $value)
    {
        return $this->instance->where($column, $operate, $value)
                              ->update(['is_enabled' => 0]);
    }

    /*
    |--------------------------------------------------------------------------
    | For Query List
    |--------------------------------------------------------------------------
    */

    /**
     * @return Eloquent
     */
    public function ofNormal()
    {
        return $this->instance::orderBy('updated_at', 'DESC');
    }

    /**
     * @return Eloquent
     */
    public function ofEnabled()
    {
        return $this->instance::ofEnabled()
                              ->orderBy('updated_at', 'DESC');
    }

    /**
     * @return Eloquent
     */
    public function ofDisabled()
    {
        return $this->instance::ofDisabled()
                              ->orderBy('updated_at', 'DESC');
    }

    /**
     * @return Eloquent
     */
    public function ofTrash()
    {
        return $this->instance::onlyTrashed()
                              ->orderBy('deleted_at', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | For List
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $code
     * @param Array   $data
     * @param Bool    $auto_packing
     * @return Array|Collection|Eloquent
     */
    public function listOnlyEnabled(string $code, array $data, $auto_packing = false)
    {
        return $this->list(
            $code         = $code,
            $data         = $data,
            $is_enabled   = true,
            $auto_packing = $auto_packing
        );
    }

    /**
     * @param String  $code
     * @param Array   $data
     * @param Bool    $auto_packing
     * @return Array|Collection|Eloquent
     */
    public function listOnlyDisabled(string $code, array $data, $auto_packing = false)
    {
        return $this->list(
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
     * @param String  $code
     * @param String  $value
     * @param Int     $count
     * @return Array
     */
    public function autoCompleteNameOfEnabled(string $code, $value, $count = 10): array
    {
        $records = $this->instance->lang()::with('morph')
                                            ->ofCurrent()
                                            ->ofCodeAndKey($code, 'name')
                                            ->whereHasMorph('morph', get_class($this->instance), function ($query) {
                                                $query->ofEnabled();
                                            })
                                            ->where('value', 'LIKE', $value .'%')
                                            ->orderBy('updated_at', 'DESC')
                                            ->select('morph_type', 'morph_id', 'value')
                                            ->take($count)
                                            ->get();
        $list = [];
        foreach ($records as $record) {
            if (property_exists($record->morph, 'sku'))
                $list[] = ['id'   => $record->morph->id,
                           'sku'  => $record->morph->sku,
                           'name' => $record->value];
            else
                $list[] = ['id'     => $record->morph->id,
                           'serial' => $record->morph->serial,
                           'name'   => $record->value];
        }

        return $list;
    }

    /**
     * @param String  $code
     * @param String  $value
     * @param Int     $count
     * @return Array
     */
    public function autoCompleteSerialOfEnabled(string $code, $value, $count = 10): array
    {
        $records = $this->instance::with(['langs' => function ($query) use ($code) {
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
            $list[] = ['id'     => $record->id,
                       'serial' => $record->serial,
                       'name'   => $record->findLangByKey('name')];
        }

        return $list;
    }

    /*
    |--------------------------------------------------------------------------
    | Find an instance to show
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $id
     * @param String  $code
     * @return Array
     *
     * @throws NotFoundEntityException
     */
    public function showById(int $id, string $code): array
    {
        $instance = $this->instance->with(['langs' => function ($query) use ($code) {
                                        $query->ofCurrent()
                                              ->ofCode($code);
                                    }])
                                    ->where('id', $id)
                                    ->first();
        if (empty($instance))
            throw new NotFoundEntityException($id);

        return $this->show($instance);
    }

    /**
     * @param String  $identifier
     * @param String  $code
     * @return Array
     */
    public function showByIdentifier(string $identifier, string $code): array
    {
        $instance = $this->instance->with(['langs' => function ($query) use ($code) {
                                        $query->ofCurrent()
                                              ->ofCode($code);
                                    }])
                                    ->where('identifier', $identifier)
                                    ->orderBy('updated_at', 'DESC')
                                    ->first();
        if (empty($instance))
            throw new NotFoundEntityException($identifier);

        return $this->show($instance);
    }
}
