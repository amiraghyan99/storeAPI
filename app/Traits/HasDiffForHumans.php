<?php

namespace App\Traits;

trait HasDiffForHumans
{
    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->diffForHumans();
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->diffForHumans();
    }
}
