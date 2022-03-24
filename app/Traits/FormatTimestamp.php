<?php


namespace App\Traits;


use Illuminate\Support\Carbon;

trait FormatTimestamp
{

    public function getCreatedAtAttribute()
    {
        if(\App::getLocale() == 'es') {
            return Carbon::parse($this->attributes['created_at'])->format('d/m/Y h:i:s A');
        }

        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:i:s A');

    }

    public function getUpdatedAtAttribute()
    {
        if(\App::getLocale() == 'es') {
            return Carbon::parse($this->attributes['updated_at'])->format('d/m/Y h:i:s A');
        }

        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d h:i:s A');
    }


}
