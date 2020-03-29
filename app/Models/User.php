<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\DoctorProfile;
use App\Models\UserDiagnosisLog;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // assign UUID value by default on model creation

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
