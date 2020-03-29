<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\UserDiagnosisLog;

class Disease extends Model
{
    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'diseases';

    /**
     * The user_diagnosis_logs that belong to the disease.
     */
    public function user_diagnosis_logs(){
        return $this->hasMany(UserDiagnosisLog::class, 'disease_id');
    }
}
