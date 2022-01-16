<?php

namespace WalkerChiu\Core\Models\Forms;

trait FormTrait
{
    /*
    |--------------------------------------------------------------------------
    | Check Exist on Name
    |--------------------------------------------------------------------------
    */

    /**
     * @param $relation
     * @param String  $code
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistName(string $code, ?string $id, $value): bool
    {
        return $this->instance->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->when($id, function ($query, $id) {
                                        return $query->whereHasMorph('morph', get_class($this->instance), function ($query) use ($id) {
                                                    $query->when($id, function ($query, $id) {
                                                        return $query->where('id', '<>', $id);
                                                    });
                                           });
                                        })
                                    ->where('value', $value)
                                    ->exists();
    }

    /**
     * @param $relation
     * @param String  $code
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistNameOfEnabled(string $code, ?string $id, $value): bool
    {
        return $this->instance->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->whereHasMorph('morph', get_class($this->instance), function ($query) use ($id) {
                                        $query->ofEnabled()
                                              ->when($id, function ($query, $id) {
                                                    return $query->where('id', '<>', $id);
                                                });
                                       })
                                    ->where('value', $value)
                                    ->exists();
    }





    /**
     * @param String  $id
     * @return Eloquent
     */
    public function baseQueryForForm(?string $id)
    {
        return $this->instance->when($id, function ($query, $id) {
                                return $query->where('id', '<>', $id);
                            });
    }

    /*
    |--------------------------------------------------------------------------
    | Check Exist on Serial
    |--------------------------------------------------------------------------
    */

    /**
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistSerial(?string $id, $value): bool
    {
        return $this->baseQueryForForm($id)
                    ->where('serial', $value)
                    ->exists();
    }

    /**
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistSerialOfEnabled(?string $id, $value): bool
    {
        return $this->baseQueryForForm($id)
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
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistIdentifier(?string $id, $value): bool
    {
        return $this->baseQueryForForm($id)
                    ->where('identifier', $value)
                    ->exists();
    }

    /**
     * @param String  $id
     * @param Mixed   $value
     * @return Bool
     */
    public function checkExistIdentifierOfEnabled(?string $id, $value): bool
    {
        return $this->baseQueryForForm($id)
                    ->where('identifier', $value)
                    ->ofEnabled()
                    ->exists();
    }
}
