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
     * @param String     $code
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistName(String $code, $id, $value)
    {
        return $this->entity->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->when($id, function ($query, $id) {
                                        return $query->whereHasMorph('morph', $this->entity->morph_type, function($query) use ($id) {
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
     * @param String     $code
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistNameOfEnabled(String $code, $id, $value)
    {
        return $this->entity->lang()::ofCurrent()
                                    ->ofCodeAndKey($code, 'name')
                                    ->whereHasMorph('morph', $this->entity->morph_type, function($query) use ($id) {
                                        $query->ofEnabled()
                                              ->when($id, function ($query, $id) {
                                                    return $query->where('id', '<>', $id);
                                                });
                                       })
                                    ->where('value', $value)
                                    ->exists();
    }





    /**
     * @param Int|String $id
     * @return Query
     */
    public function baseQueryForForm($id)
    {
        return $this->entity->when($id, function ($query, $id) {
                                return $query->where('id', '<>', $id);
                              });
    }

    /*
    |--------------------------------------------------------------------------
    | Check Exist on Serial
    |--------------------------------------------------------------------------
    */

    /**
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistSerial($id, $value)
    {
        return $this->baseQueryForForm($id)
                    ->where('serial', $value)
                    ->exists();
    }

    /**
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistSerialOfEnabled($id, $value)
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
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistIdentifier($id, $value)
    {
        return $this->baseQueryForForm($id)
                    ->where('identifier', $value)
                    ->exists();
    }

    /**
     * @param Int|String $id
     * @param Any        $value
     * @return Boolean
     */
    public function checkExistIdentifierOfEnabled($id, $value)
    {
        return $this->baseQueryForForm($id)
                    ->where('identifier', $value)
                    ->ofEnabled()
                    ->exists();
    }
}
