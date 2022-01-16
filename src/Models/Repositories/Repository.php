<?php

namespace WalkerChiu\Core\Models\Repositories;

use WalkerChiu\Core\Models\Entities\Entity;

abstract class Repository
{
    /**
     * @var \Illuminate\Database\Eloquent\Entity
     */
    protected $instance;

    public function __construct($instance = null)
    {
        $this->instance = $instance;
    }


    /*
    |--------------------------------------------------------------------------
    | Initial
    |--------------------------------------------------------------------------
    */

    /**
     * @return Entity
     */
    public function getEntity()
    {
        return $this->instance;
    }

    /**
     * @param Entity $instance
     * @return void
     */
    public function setEntity($instance)
    {
        $this->instance = $instance;
    }


    /*
    |--------------------------------------------------------------------------
    | Get and Find
    |--------------------------------------------------------------------------
    */

    /**
     * @return Collection
     */
    public function get()
    {
        return $this->instance->all();
    }

    /**
     * @return $query
     */
    public function getAllId()
    {
        return $this->instance->pluck('id');
    }

    /**
     * @param Int  $count
     * @return $query
     */
    public function getPaginated(int $count)
    {
        return $this->instance->paginate($count);
    }

    /**
     * @return Entity
     */
    public function first()
    {
        return $this->instance->first();
    }

    /**
     * @return Entity
     */
    public function latest()
    {
        return $this->instance->latest()->first();
    }

    /**
     * @param String  $id
     * @param Array   $relations
     * @return Entity
     */
    public function find(string $id, $relations = null)
    {
        return $this->instance->unless(empty($relations), function ($query) use ($relations) {
                                    return $query->with($relations);
                                })
                                ->find($id);
    }

    /**
     * @param String  $serial
     * @param Array   $relations
     * @return Entity
     */
    public function findBySerial(string $serial, $relations = null)
    {
        return $this->instance->unless(empty($relations), function ($query) use ($relations) {
                                    return $query->with($relations);
                                })
                                ->where('serial', $serial)
                                ->orderBy('updated_at', 'DESC')
                                ->first();
    }

    /**
     * @param String  $identifier
     * @param Array   $relations
     * @return Entity
     */
    public function findByIdentifier(string $identifier, $relations = null)
    {
        return $this->instance->unless(empty($relations), function ($query) use ($relations) {
                                    return $query->with($relations);
                                })
                                ->where('identifier', $identifier)
                                ->orderBy('updated_at', 'DESC')
                                ->first();
    }

    /**
     * @param String  $id
     * @param Array   $relations
     * @return Entity
     */
    public function findOrFail(string $id, $relations = null)
    {
        return $this->instance->unless(empty($relations), function ($query) use ($relations) {
                                    return $query->with($relations);
                                })
                                ->findOrFail($id);
    }

    /**
     * @param String  $id
     * @param Array   $relations
     * @return Entity
     */
    public function findWithTrashed(string $id, $relations = null)
    {
        return $this->instance->withTrashed()
                                ->unless(empty($relations), function ($query) use ($relations) {
                                        return $query->with($relations);
                                    })
                                ->find($id);
    }

    /**
     * @param String  $id
     * @param Array   $relations
     * @return Entity
     */
    public function findOrFailWithTrashed(string $id, $relations = null)
    {
        return $this->instance->withTrashed()
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
     * @param String  $id
     * @return Bool
     */
    public function enableById(string $id): bool
    {
        $instance = $this->find($id);

        return $instance
                ? (bool) $instance->update(['is_enabled' => 1])
                : false;
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function enableByIds(array $data): bool
    {
        return (bool) $instance->whereIn('id', $data)
                               ->update(['is_enabled' => 1]);
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function enableByExceptIds(array $data): bool
    {
        return (bool) $instance->whereNotIn('id', $data)
                               ->update(['is_enabled' => 1]);
    }

    /**
     * @param String  $id
     * @return Bool
     */
    public function disableById(string $id): bool
    {
        $instance = $this->find($id);

        return $instance
                ? (bool) $instance->update(['is_enabled' => 0])
                : false;
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function disableByIds(array $data): bool
    {
        return (bool) $instance->whereIn('id', $data)
                               ->update(['is_enabled' => 0]);
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function disableByExceptIds(array $data): bool
    {
        return (bool) $instance->whereNotIn('id', $data)
                               ->update(['is_enabled' => 0]);
    }


    /*
    |--------------------------------------------------------------------------
    | Query Builder
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @return Eloquent
     */
    public function where(string $column, string $operate, $value)
    {
        return $this->instance->where($column, $operate, $value);
    }

    /**
     * @param Array  $array
     * @return Eloquent
     */
    public function whereByArray(array $array)
    {
        return $this->instance->where($array);
    }

    /**
     * @param String  $column
     * @return Eloquent
     */
    public function whereNull(string $column)
    {
        return $this->instance->whereNull($column);
    }

    /**
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @return Eloquent
     */
    public function whereWithTrashed(string $column, string $operate, $value)
    {
        return $this->instance->withTrashed()
                              ->where($column, $operate, $value);
    }

    /**
     * @param Array  $array
     * @return Eloquent
     */
    public function whereByArrayWithTrashed(array $array)
    {
        return $this->instance->withTrashed()
                              ->where($array);
    }

    /**
     * @param String  $column
     * @param String  $operate
     * @param Mixed   $value
     * @return Eloquent
     */
    public function whereOnlyTrashed(string $column, string $operate, $value)
    {
        return $this->instance->onlyTrashed()
                              ->where($column, $operate, $value);
    }

    /**
     * @param Array  $array
     * @return Eloquent
     */
    public function whereByArrayOnlyTrashed(array $array)
    {
        return $this->instance->onlyTrashed()
                              ->where($array);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereIn(string $column, array $value)
    {
        return $this->instance->whereIn($column, $value);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereInWithTrashed(string $column, array $value)
    {
        return $this->instance->withTrashed()
                              ->whereIn($column, $value);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereInOnlyTrashed(string $column, array $value)
    {
        return $this->instance->onlyTrashed()
                              ->whereIn($column, $value);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereNotIn(string $column, array $value)
    {
        return $this->instance->whereNotIn($column, $value);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereNotInWithTrashed(string $column, array $value)
    {
        return $this->instance->withTrashed()
                              ->whereNotIn($column, $value);
    }

    /**
     * @param String  $column
     * @param Array   $value
     * @return Eloquent
     */
    public function whereNotInOnlyTrashed(string $column, array $value)
    {
        return $this->instance->onlyTrashed()
                              ->whereNotIn($column, $value);
    }


    /*
    |--------------------------------------------------------------------------
    | Count
    |--------------------------------------------------------------------------
    */

    /**
     * @return Int
     */
    public function count(): int
    {
        return $this->instance->count();
    }

    /**
     * @return Int
     */
    public function countAll(): int
    {
        return $this->instance->withTrashed()
                              ->count();
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array  $data
     * @return Entity
     */
    public function create(array $data)
    {
        return $this->instance->create($data);
    }

    /**
     * @param Array  $attributes
     * @return Entity
     */
    public function getNew($attributes = [])
    {
        return $this->instance->newInstance($attributes);
    }

    /**
     * @param Entity|Array  $data
     * @return Entity
     */
    public function save($data)
    {
        if ($data instanceOf Entity)
            return $this->storeEntity($data);
        elseif (is_array($data))
            return $this->storeArray($data);
    }

    /**
     * @param Entity  $instance
     * @return Entity
     */
    protected function storeEntity($instance)
    {
        if ($instance->getDirty())
            $instance->save();
        else
            $instance->touch();

        return $instance;
    }

    /**
     * @param Array  $data
     * @return Entity
     */
    protected function storeArray(array $data)
    {
        $instance = $this->getNew($data);

        return $this->storeEntity($instance);
    }

    /**
     * @param Array  $attributes
     * @param Array  $values
     * @return Entity
     */
    public function updateOrCreate(array $attributes, $values = [])
    {
        return $this->instance->updateOrCreate($attributes, $values);
    }

    /**
     * @param Array  $attributes
     * @param Array  $values
     * @return Entity
     */
    public function firstOrCreate(array $attributes, $values = [])
    {
        return $this->instance->firstOrCreate($attributes, $values);
    }

    /**
     * @param Array  $attributes
     * @param Array  $values
     * @return Entity
     */
    public function firstOrNew(array $attributes, $values = [])
    {
        return $this->instance->firstOrNew($attributes, $values);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    /**
     * @return Bool
     */
    public function forceDelete(): bool
    {
        $this->instance->withTrashed()
                       ->forceDelete();
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function deleteByIds(array $data): bool
    {
        return $this->instance->whereIn('id', $data)
                              ->delete();
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function forceDeleteByIds(array $data): bool
    {
        return $this->instance->withTrashed()
                              ->whereIn('id', $data)
                              ->forceDelete();
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function deleteByExceptIds(array $data): bool
    {
        return $this->instance->whereNotIn('id', $data)
                              ->delete();
    }

    /**
     * @param Array  $data
     * @return Bool
     */
    public function forceDeleteByExceptIds(array $data): bool
    {
        return $this->instance->withTrashed()
                              ->whereNotIn('id', $data)
                              ->forceDelete();
    }


    /*
    |--------------------------------------------------------------------------
    | Restore
    |--------------------------------------------------------------------------
    */

    /**
     * @param Array  $data
     * @return Bool
     */
    public function restoreByIds(array $data): bool
    {
        return $this->instance->onlyTrashed()
                              ->whereIn('id', $data)
                              ->restore();
    }
}
