<?php

namespace WalkerChiu\Core\Models\Services;

trait CheckExistTrait
{
    /**
     * @param String $serial
     * @param String $id
     * @return Boolean
     */
    public function checkExistSerial(String $serial, $id = null)
    {
        return $this->repository->where('serial', '=', $serial)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param String $identifier
     * @param String $id
     * @return Boolean
     */
    public function checkExistIdentifier(String $identifier, $id = null)
    {
        return $this->repository->where('identifier', '=', $identifier)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param Boolean $is_enabled
     * @param String  $id
     * @return Boolean
     */
    public function checkExistIsEnabled(String $is_enabled, $id = null)
    {
        return $this->repository->where('is_enabled', '=', $is_enabled)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param Boolean $is_highlighted
     * @param String  $id
     * @return Boolean
     */
    public function checkExistIsHighlighted(String $is_highlighted, $id = null)
    {
        return $this->repository->where('is_highlighted', '=', $is_highlighted)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }
}
