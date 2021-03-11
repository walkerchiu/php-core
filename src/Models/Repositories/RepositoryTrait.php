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
     * @param String  $user_id
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

    /*
    |--------------------------------------------------------------------------
    | Enable and Disable
    |--------------------------------------------------------------------------
    */

    /**
     * @param String $column
     * @param String $operate
     * @param Any    $value
     * @return Query
     */
    public function whereToEnable($column, $operate, $value)
    {
        return $this->entity->where($column, $operate, $value)
                            ->update(['is_enabled' => 1]);
    }

    /**
     * @param String $column
     * @param String $operate
     * @param Any    $value
     * @return Query
     */
    public function whereToDisable($column, $operate, $value)
    {
        return $this->entity->where($column, $operate, $value)
                            ->update(['is_enabled' => 0]);
    }

    /*
    |--------------------------------------------------------------------------
    | For Query List
    |--------------------------------------------------------------------------
    */

    /**
     * @param None
     * @return Array
     */
    public function ofNormal()
    {
        return $this->entity::orderBy('updated_at', 'DESC');
    }

    /**
     * @param None
     * @return Array
     */
    public function ofEnabled()
    {
        return $this->entity::ofEnabled()
                            ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param None
     * @return Array
     */
    public function ofDisabled()
    {
        return $this->entity::ofDisabled()
                            ->orderBy('updated_at', 'DESC');
    }

    /**
     * @param None
     * @return Array
     */
    public function ofTrash()
    {
        return $this->entity::onlyTrashed()
                            ->orderBy('deleted_at', 'DESC');
    }

    /*
    |--------------------------------------------------------------------------
    | For List
    |--------------------------------------------------------------------------
    */

    /**
     * @param String $code
     * @param Array  $data
     * @param Int    $page
     * @param Int    $nums per page
     * @return Array
     */
    public function listOnlyEnabled(String $code, Array $data, $page = null, $nums = null)
    {
        return $this->list($code, $data, $page, $nums, true);
    }

    /**
     * @param String $code
     * @param Array  $data
     * @param Int    $page
     * @param Int    $nums per page
     * @return Array
     */
    public function listOnlyDisabled(String $code, Array $data, $page = null, $nums = null)
    {
        return $this->list($code, $data, $page, $nums, false);
    }

    /*
    |--------------------------------------------------------------------------
    | For Auto Complete
    |--------------------------------------------------------------------------
    */

    /**
     * @param $relation
     * @param String $code
     * @param Any    $value
     * @param Int    $count
     * @return Array
     */
    public function autoCompleteNameOfEnabled(String $code, $value, $count = 10)
    {
        $records = $this->entity->lang()::with('morph')
                                        ->ofCurrent()
                                        ->ofCodeAndKey($code, 'name')
                                        ->whereHasMorph('morph', $this->entity->morph_type, function($query) {
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
     * @param $relation
     * @param String $code
     * @param Any    $value
     * @param Int    $count
     * @return Array
     */
    public function autoCompleteSerialOfEnabled(String $code, $value, $count = 10)
    {
        $records = $this->entity::with(['langs' => function ($query) use ($code) {
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
    | Find an entity to show
    |--------------------------------------------------------------------------
    */

    /**
     * @param String $id
     * @param String $code
     * @return Array
     */
    public function showById(Int $id, $code)
    {
        $entity = $this->entity->with(['langs' => function ($query) use ($code) {
                                    $query->ofCurrent()
                                          ->ofCode($code);
                                }])
                               ->where('id', $id)
                               ->first();
        if (empty($entity)) throw new NotFoundEntityException($id);

        return $this->show($entity);
    }

    /**
     * @param String $identifier
     * @param String $code
     * @return Array
     */
    public function showByIdentifier(String $identifier, $code)
    {
        $entity = $this->entity->with(['langs' => function ($query) use ($code) {
                                    $query->ofCurrent()
                                          ->ofCode($code);
                                }])
                               ->where('identifier', $identifier)
                               ->orderBy('updated_at', 'DESC')
                               ->first();
        if (empty($entity)) throw new NotFoundEntityException($identifier);

        return $this->show($entity);
    }
}
