<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

class Message extends Model
{
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'messages';
}
