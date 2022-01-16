<?php

namespace WalkerChiu\Core\Models\Entities;

use WalkerChiu\Core\Models\Entities\Lang;

class LangCore extends Lang
{
    /**
     * Create a new instance.
     *
     * @param Array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('wk-core.table.core.lang_core');

        parent::__construct($attributes);
    }
}
