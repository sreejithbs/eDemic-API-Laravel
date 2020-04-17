<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

use App\Models\HealthInstitution;

class Payment extends Model
{
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'payments';

    /**
     * The health_institution that belong to the payment.
     */
    public function health_institution(){
        return $this->belongsTo(HealthInstitution::class, 'health_institution_id');
    }
}