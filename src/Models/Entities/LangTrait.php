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
     * @param Bool    $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findLang(string $code, string $key, $type = 'value')
    {
        $lang = $this->langs()->where('is_current', 1)
                              ->where('code', $code)
                              ->where('key', $key)
                              ->orderBy('updated_at', 'DESC')
                              ->first();
        if ($type == 'value')
            return empty($lang) ? null : $lang->value;
        else
            return $lang;
    }

    /**
     * @param String  $key
     * @param Bool    $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findLangByKeyWithLocale(string $key, $type = 'value')
    {
        $code = app()->getLocale();
        $lang = $this->langs()->where('is_current', 1)
                              ->where('code', $code)
                              ->where('key', $key)
                              ->orderBy('id', 'DESC')
                              ->first();
        if ($type == 'value')
            return empty($lang) ? null : $lang->value;
        else
            return $lang;
    }

    /**
     * @param String  $key
     * @param Bool    $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findLangByKey(string $key, $type = 'value')
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
     * @param String  $code
     * @param String  $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getHistories(string $code, string $key)
    {
        return $this->langs()->where('is_current', 0)
                             ->where('code', $code)
                             ->where('key', $key)
                             ->orderBy('updated_at', 'DESC')
                             ->get();
    }
}
