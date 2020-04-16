<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserLocationLog extends Model
{
    protected $table = 'user_location_logs';

    /**
     * List the fields that would automatically be appended
     *
     * @var array
     */
    protected $appends = ['date_time_formatted'];

    public function getDateTimeFormattedAttribute()
    {
        return Carbon::parse($this->attributes['dateTime'])->format('Y-m-d g:i A');
    }
}
