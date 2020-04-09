<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

use App\Models\User;
use App\Models\HealthInstitution;

class DoctorProfile extends Model
{
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'doctor_profiles';

    /**
     * The user that belong to the doctor_profile.
     */
    public function user(){
        return $this->hasOne(User::class, 'is_doctor_id');
    }

    /**
     * The health_institution that belong to the doctor_profile.
     */
    public function health_institution(){
        return $this->belongsTo(HealthInstitution::class, 'health_institution_id');
    }
}