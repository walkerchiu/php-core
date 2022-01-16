<?php

namespace WalkerChiu\Core\Models\Forms;

trait FormHasHostTrait
{
    /*
    |--------------------------------------------------------------------------
    | Check Exist on Name
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $code
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistName(?string $host_type, ?string $host_id, string $code, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->instance->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->unless(
                                        empty($host_id)
                                        && empty($host_type)
                                        && empty($id)
                                    , function ($query) use ($host_type, $host_id, $id) {
                                        return $query->whereHasMorph('morph', get_class($this->instance), function ($query) use ($host_type, $host_id, $id) {
                                                $query->unless(
                                                            empty($host_type)
                                                            || empty($host_id)
                                                        , function ($query) use ($host_type) {
                                                            return $query->whereHasMorph('host', $host_type);
                                                        })
                                                      ->when($id, function ($query, $id) {
                                                            return $query->where('id', '<>', $id);
                                                        });
                                           });
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
                                        })
                                    ->where('value', $value)
                                    ->exists();
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $code
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistNameOfEnabled(?string $host_type, ?string $host_id, string $code, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->instance->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->whereHasMorph('morph', get_class($this->instance), function ($query) use ($host_type, $host_id, $id) {
                                        return $query->ofEnabled()
                                                     ->when($id, function ($query, $id) {
                                                            return $query->where('id', '<>', $id);
                                                        })
                                                     ->unless(
                                                            empty($host_type)
                                                            || empty($host_id)
                                                        , function ($query) use ($host_type) {
                                                            return $query->whereHasMorph('host', $host_type);
                                                        });
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
                                        })

                                    ->where('value', $value)
                                    ->exists();
    }





    /**
     * @param String      $host_type
     * @param String      $host_id
     * @param Int|String  $id
     * @param String      $target
     * @param Bool        $target_is_enabled
     * @return Eloquent
     */
    public function baseQueryForForm(?string $host_type, ?string $host_id, ?string $id, ?string $target, ?bool $target_is_enabled)
    {
        return $this->instance->unless(
                                empty($host_type)
                                && empty($host_id)
                            , function ($query) use ($host_type, $host_id) {
                                    return $query->whereHasMorph('host', $host_type);
                                })
                            ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
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
    | Check Exist on Serial
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistSerial(?string $host_type, ?string $host_id, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('serial', $value)
                    ->exists();
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistSerialOfEnabled(?string $host_type, ?string $host_id, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('serial', $value)
                    ->ofEnabled()
                    ->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Check Exist on Identifier
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistIdentifier(?string $host_type, ?string $host_id, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('identifier', $value)
                    ->exists();
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Mixed   $value
     * @param String  $target
     * @param Bool    $target_is_enabled
     * @return Bool
     */
    public function checkExistIdentifierOfEnabled(?string $host_type, ?string $host_id, ?string $id, $value, $target = null, $target_is_enabled = null): bool
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('identifier', $value)
                    ->ofEnabled()
                    ->exists();
    }
}
