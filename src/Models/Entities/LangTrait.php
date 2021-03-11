<?php

namespace WalkerChiu\Core\Models\Entities;

use WalkerChiu\Core\Models\Entities\LangCore;

trait LangTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function langsCore()
    {
        return $this->morphMany(config('wk-core.class.core.langCore'), 'morph');
    }

    /**
     * @param String  $code
     * @param String  $key
     * @param Boolean $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findLang(String $code, String $key, $type = 'value')
    {
        $lang = $this->langs->where('is_current', 1)
                            ->where('code', $code)
                            ->where('key', $key)
                            ->sortByDESC('updated_at')
                            ->first();
        if ($type == 'value')
            return empty($lang) ? null : $lang->value;
        else
            return $lang;
    }

    /**
     * @param String  $key
     * @param Boolean $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findLangByKey(String $key, $type = 'value')
    {
        $lang = $this->langs->where('is_current', 1)
                            ->where('key', $key)
                            ->sortByDESC('updated_at')
                            ->first();
        if ($type == 'value')
            return empty($lang) ? null : $lang->value;
        else
            return $lang;
    }

    /**
     * @param String $code
     * @param String $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getHistories(String $code, String $key)
    {
        return $this->langs->where('is_current', 0)
                           ->where('code', $code)
                           ->where('key', $key)
                           ->sortByDESC('updated_at')
                           ->all();
    }
}
