<?php

namespace WalkerChiu\Core\Models\Services;

trait CheckExistTrait
{
    /**
     * @param String  $serial
     * @param String  $id
     * @return Bool
     */
    public function checkExistSerial(string $serial, $id = null): bool
    {
        return $this->repository->where('serial', '=', $serial)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param String  $identifier
     * @param String  $id
     * @return Bool
     */
    public function checkExistIdentifier(string $identifier, $id = null): bool
    {
        return $this->repository->where('identifier', '=', $identifier)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param Bool    $is_enabled
     * @param String  $id
     * @return Bool
     */
    public function checkExistIsEnabled(string $is_enabled, $id = null): bool
    {
        return $this->repository->where('is_enabled', '=', $is_enabled)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }

    /**
     * @param Bool    $is_highlighted
     * @param String  $id
     * @return Bool
     */
    public function checkExistIsHighlighted(string $is_highlighted, $id = null): bool
    {
        return $this->repository->where('is_highlighted', '=', $is_highlighted)
                                ->when($id, function ($query, $id) {
                                    return $query->where('id', '<>', $id);
                                  })
                                ->exists();
    }
}
