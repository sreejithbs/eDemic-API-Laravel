<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Message extends Model
{
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'messages';

    /**
     * Scope a query to only include posted messages
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsPosted($query)
    {
        return $query->where('isPosted', 1);
    }
}
