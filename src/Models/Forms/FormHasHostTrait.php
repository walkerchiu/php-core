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
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Boolean
     */
    public function checkExistName($host_type, $host_id, String $code, $id, $value, $target = null, $target_is_enabled = null)
    {
        return $this->entity->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->unless(empty($host_id) && empty($host_type) && empty($id), function ($query) use ($host_type, $host_id, $id) {
                                        return $query->whereHasMorph('morph', $this->entity->morph_type, function($query) use ($host_type, $host_id, $id) {
                                                $query->unless(empty($host_type) || empty($host_id), function ($query) use ($host_type) {
                                                            return $query->whereHasMorph('host', $host_type);
                                                        })
                                                      ->when($id, function ($query, $id) {
                                                            return $query->where('id', '<>', $id);
                                                        });
                                           });
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
                                        })
                                    ->where('value', $value)
                                    ->exists();
    }

    /**
     * @param String     $host_type
     * @param String     $host_id
     * @param String     $code
     * @param Int|String $id
     * @param Any        $value
     * @param String     $target
     * @param Boolean    $target_is_enabled
     * @return Boolean
     */
    public function checkExistNameOfEnabled($host_type, $host_id, String $code, $id, $value, $target = null, $target_is_enabled = null)
    {
        return $this->entity->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->whereHasMorph('morph', $this->entity->morph_type, function($query) use ($host_type, $host_id, $id) {
                                        return $query->ofEnabled()
                                                      ->when($id, function ($query, $id) {
                                                            return $query->where('id', '<>', $id);
                                                        })
                                                      ->unless(empty($host_type) || empty($host_id), function ($query) use ($host_type) {
                                                            return $query->whereHasMorph('host', $host_type);
                                                        });
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
                                        })

                                    ->where('value', $value)
                                    ->exists();
    }





    /**
     * @param String     $host_type
     * @param String     $host_id
     * @param Int|String $id
     * @param String     $target
     * @param Boolean    $target_is_enabled
     * @return Query
     */
    public function baseQueryForForm($host_type, $host_id, $id, $target = null, $target_is_enabled = null)
    {
        return $this->entity->unless(empty($host_type) && empty($host_id), function ($query) use ($host_type, $host_id) {
                                    return $query->whereHasMorph('host', $host_type);
                                })
                            ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
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
    | Check Exist on Serial
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Boolean
     */
    public function checkExistSerial($host_type, $host_id, $id, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('serial', $value)
                    ->exists();
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Boolean
     */
    public function checkExistSerialOfEnabled($host_type, $host_id, $id, $value, $target = null, $target_is_enabled = null)
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
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Boolean
     */
    public function checkExistIdentifier($host_type, $host_id, $id, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('identifier', $value)
                    ->exists();
    }

    /**
     * @param String  $host_type
     * @param String  $host_id
     * @param String  $id
     * @param Any     $value
     * @param String  $target
     * @param Boolean $target_is_enabled
     * @return Boolean
     */
    public function checkExistIdentifierOfEnabled($host_type, $host_id, $id, $value, $target = null, $target_is_enabled = null)
    {
        return $this->baseQueryForForm($host_type, $host_id, $id, $target, $target_is_enabled)
                    ->where('identifier', $value)
                    ->ofEnabled()
                    ->exists();
    }
}
