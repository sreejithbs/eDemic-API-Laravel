<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    /**
     * Binds creating/saving events to create UUIDs (and also prevent them from being overwritten).
     *
     * @return void
     */
    protected static function bootUuidTrait()
    {
        self::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    // Return model instance or null by checking `uuid` data
    public static function fetchModelByUnqId($uuid)
    {
        return static::where('uuid', $uuid)->first();
    }
}