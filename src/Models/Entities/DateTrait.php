<?php

namespace WalkerChiu\Core\Models\Entities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

trait DateTrait
{
    public function getTimezone()
    {
        return Session::get('timezone', config('wk-core.timezone'));
    }

    public function getCreatedAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['created_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['created_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['created_at'])->setTimezone($this->getTimezone());
    }

    public function getUpdatedAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['updated_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['updated_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['updated_at'])->setTimezone($this->getTimezone());
    }

    public function getDeletedAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['deleted_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['deleted_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['deleted_at'])->setTimezone($this->getTimezone());
    }

    public function getLoginAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['login_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['login_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['login_at'])->setTimezone($this->getTimezone());
    }

    public function getLogoutAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['logout_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['logout_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['logout_at'])->setTimezone($this->getTimezone());
    }

    public function getEditAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['edit_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['edit_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['edit_at'])->setTimezone($this->getTimezone());
    }

    public function getTriggerAtAttribute()
    {
        if (config('wk-core.datetime.onoff')) {
            return empty($this->attributes['trigger_at']) ? config('wk-core.datetime.null') :
                Carbon::parse($this->attributes['trigger_at'])->setTimezone($this->getTimezone())
                      ->format(config('wk-core.datetime.format'));
        }
        return Carbon::parse($this->attributes['trigger_at'])->setTimezone($this->getTimezone());
    }
}
