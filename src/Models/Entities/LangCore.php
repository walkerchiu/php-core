<?php

namespace WalkerChiu\Core\Models\Entities;

use WalkerChiu\Core\Models\Entities\Lang;

class LangCore extends Lang
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->table = config('wk-core.table.core.lang_core');

        parent::__construct($attributes);
    }
}
