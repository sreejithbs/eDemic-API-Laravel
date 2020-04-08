<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidTrait;

use App\Models\User;

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
}