<?php

namespace WalkerChiu\Core\Models\Repositories;

use WalkerChiu\Core\Models\Entities\Entity;
use WalkerChiu\Core\Models\Exceptions\NotUnsignedIntegerException;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Entity
     */
    protected $entity;

    public function __construct($entity = null)
    {
        $this->entity = $entity;
    }


    /*
    |--------------------------------------------------------------------------
    | Assert
    |--------------------------------------------------------------------------
    */

    /**
     * @param Int $page
     * @param Int $nums
     * @return void
     */
    public function assertForPagination($page, $nums)
    {
        if (!is_null($page) && is_integer($page) && $page <= 0)
            throw new NotUnsignedIntegerException($page);
        elseif (!is_null($nums) && is_integer($nums) && $nums <= 0)
            throw new NotUnsignedIntegerException($nums);
    }


    /*
    |--------------------------------------------------------------------------
    | Initial
    |--------------------------------------------------------------------------
    */

    /**
     * @param None
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     * @return void
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }


    /*
    |--------------------------------------------------------------------------
    | Get and Find
    |--------------------------------------------------------------------------
    */

    /**
     * @param None
     * @return Collection
     */
    public function get()
    {
        return $this->entity->all();
    }

    /**
     * @return $query
     */
    public function getAllId()
    {
        return $this->entity->pluck('id');
    }

    /**
     * @param Int $count
     * @return $query
     */
    public function getPaginated(Int $count)
    {
        return $this->entity->paginate($count);
    }

    /**
     * @param String $id
     * @param Array  $relations
     * @return Entity
     */
    public function find(String $id, $relations = null)
    {
        return $this->entity->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->find($id);
    }

    /**
     * @param String $serial
     * @param Array  $relations
     * @return Entity
     */
    public function findBySerial(String $serial, $relations = null)
    {
        return $this->entity->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->where('serial', $serial)
                            ->orderBy('updated_at', 'DESC')
                            ->first();
    }

    /**
     * @param String $identifier
     * @param Array  $relations
     * @return Entity
     */
    public function findByIdentifier(String $identifier, $relations = null)
    {
        return $this->entity->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->where('identifier', $identifier)
                            ->orderBy('updated_at', 'DESC')
                            ->first();
    }

    /**
     * @param String $id
     * @param Array  $relations
     * @return Entity
     */
    public function findOrFail(String $id, $relations = null)
    {
        return $this->entity->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->findOrFail($id);
    }

    /**
     * @param String $id
     * @param Array  $relations
     * @return Entity
     */
    public function findWithTrashed(String $id, $relations = null)
    {
        return $this->entity->withTrashed()
                            ->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->find($id);
    }

    /**
     * @param String $id
     * @param Array  $relations
     * @return Entity
     */
    public function findOrFailWithTrashed(String $id, $relations = null)
    {
        return $this->entity->withTrashed()
                            ->unless(empty($relations), function ($query) use ($relations) {
                                return $query->with($relations);
                                })
                            ->findOrFail($id);
    }


    /*
    |--------------------------------------------------------------------------
    | Enable and Disable
    |--------------------------------------------------------------------------
    */

    /**
     * @param String $id
     * @return Boolean
     */
    public function enableById(String $id)
    {
        $entity = $this->find($id);

        return $entity ? $entity->update(['is_enabled' => 1]) : false;
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function enableByIds(Array $data)
    {
        return $entity->whereIn('id', $data)
                      ->update(['is_enabled' => 1]);
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function enableByExceptIds(Array $data)
    {
        return $entity->whereNotIn('id', $data)
                      ->update(['is_enabled' => 1]);
    }

    /**
     * @param String $id
     * @return Boolean
     */
    public function disableById(String $id)
    {
        $entity = $this->find($id);

        return $entity ? $entity->update(['is_enabled' => 0]) : false;
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function disableByIds(Array $data)
    {
        return $entity->whereIn('id', $data)
                      ->update(['is_enabled' => 0]);
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function disableByExceptIds(Array $data)
    {
        return $entity->whereNotIn('id', $data)
                      ->update(['is_enabled' => 0]);
    }


    /*
    |--------------------------------------------------------------------------
    | Query Builder
    |--------------------------------------------------------------------------
    */

    /**
     * @param String $column
     * @param String $operate
     * @param Any $value
     * @return Query
     */
    public function where($column, $operate, $value)
    {
        return $this->entity->where($column, $operate, $value);
    }

    /**
     * @param Array $array
     * @return Query
     */
    public function whereByArray($array)
    {
        return $this->entity->where($array);
    }

    /**
     * @param String $column
     * @param String $operate
     * @param Any $value
     * @return Query
     */
    public function whereWithTrashed($column, $operate, $value)
    {
        return $this->entity->withTrashed()
                            ->where($column, $operate, $value);
    }

    /**
     * @param Array $array
     * @return Query
     */
    public function whereByArrayWithTrashed($array)
    {
        return $this->entity->withTrashed()
                            ->where($array);
    }

    /**
     * @param String $column
     * @param String $operate
     * @param Any $value
     * @return Query
     */
    public function whereOnlyTrashed($column, $operate, $value)
    {
        return $this->entity->onlyTrashed()
                            ->where($column, $operate, $value);
    }

    /**
     * @param Array $array
     * @return Query
     */
    public function whereByArrayOnlyTrashed($array)
    {
        return $this->entity->onlyTrashed()
                            ->where($array);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereIn($column, $value)
    {
        return $this->model->whereIn($column, $value);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereInWithTrashed($column, $value)
    {
        return $this->entity->withTrashed()
                            ->whereIn($column, $value);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereInOnlyTrashed($column, $value)
    {
        return $this->entity->onlyTrashed()
                            ->whereIn($column, $value);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereNotIn($column, $value)
    {
        return $this->model->whereNotIn($column, $value);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereNotInWithTrashed($column, $value)
    {
        return $this->entity->withTrashed()
                            ->whereNotIn($column, $value);
    }

    /**
     * @param String $column
     * @param Array  $value
     * @return Query
     */
    public function whereNotInOnlyTrashed($column, $value)
    {
        return $this->entity->onlyTrashed()
                            ->whereNotIn($column, $value);
    }


    /*
    |--------------------------------------------------------------------------
    | Count
    |--------------------------------------------------------------------------
    */

    /**
     * @param None
     * @return Int
     */
    public function count()
    {
        return $this->entity->count();
    }

    /**
     * @param None
     * @return Int
     */
    public function countAll()
    {
        return $this->entity->withTrashed()
                            ->count();
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array $data
     * @return Entity
     */
    public function create(Array $data)
    {
        return $this->entity->create($data);
    }

    /**
     * @param Array $attributes
     * @return Entity
     */
    public function getNew($attributes = [])
    {
        return $this->entity->newInstance($attributes);
    }

    /**
     * @param Entity|Array $data
     * @return Entity
     */
    public function save($data)
    {
        if ($data instanceOf Entity) return $this->storeEntity($data);
        elseif (is_array($data))     return $this->storeArray($data);
    }

    /**
     * @param Entity $entity
     * @return Entity
     */
    protected function storeEntity($entity)
    {
        if ($entity->getDirty()) $entity->save();
        else                     $entity->touch();

        return $entity;
    }

    /**
     * @param Array $data
     * @return Entity
     */
    protected function storeArray(Array $data)
    {
        $entity = $this->getNew($data);

        return $this->storeEntity($entity);
    }

    /**
     * @param Array $attributes
     * @param Array $values
     * @return Entity
     */
    public function updateOrCreate(Array $attributes, $values = [])
    {
        return $this->entity->updateOrCreate($attributes, $values);
    }

    /**
     * @param Array $attributes
     * @param Array $values
     * @return Entity
     */
    public function firstOrCreate(Array $attributes, $values = [])
    {
        return $this->entity->firstOrCreate($attributes, $values);
    }

    /**
     * @param Array $attributes
     * @param Array $values
     * @return Entity
     */
    public function firstOrNew(Array $attributes, $values = [])
    {
        return $this->entity->firstOrNew($attributes, $values);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    /**
     * @param None
     * @return Boolean
     */
    public function forceDelete()
    {
        $this->entity->withTrashed()
                     ->forceDelete();
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function deleteByIds(Array $data)
    {
        return $this->entity->whereIn('id', $data)
                            ->delete();
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function forceDeleteByIds(Array $data)
    {
        return $this->entity->withTrashed()
                            ->whereIn('id', $data)
                            ->forceDelete();
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function deleteByExceptIds(Array $data)
    {
        return $this->entity->whereNotIn('id', $data)
                            ->delete();
    }

    /**
     * @param Array $data
     * @return Boolean
     */
    public function forceDeleteByExceptIds(Array $data)
    {
        return $this->entity->withTrashed()
                            ->whereNotIn('id', $data)
                            ->forceDelete();
    }


    /*
    |--------------------------------------------------------------------------
    | Restore
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array $data
     * @return Boolean
     */
    public function restoreByIds(Array $data)
    {
        $this->entity->onlyTrashed()
                     ->whereIn('id', $data)
                     ->restore();
    }
}
