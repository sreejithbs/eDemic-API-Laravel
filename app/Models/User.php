<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\DoctorProfile;
use App\Models\UserDiagnosisLog;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'users';

    /**
     * The doctor_profile that belong to the users.
     */
    public function doctor_profile(){
        return $this->hasOne(DoctorProfile::class, 'user_id');
    }

    /**
     * The patients that belong to the users.
     */
    public function patients(){
        return $this->hasMany(UserDiagnosisLog::class, 'patient_id');
    }

    /**
     * The doctors that belong to the users.
     */
    public function doctors(){
        return $this->hasMany(UserDiagnosisLog::class, 'doctor_id');
    }
}
