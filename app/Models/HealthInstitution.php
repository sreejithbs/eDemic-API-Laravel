<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\HealthInstitutionProfile;
use App\Models\LicenseSubscription;
use App\Models\Disease;
use App\Models\DoctorProfile;
use App\Models\AlertMessage;

class HealthInstitution extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // assign UUID value by default on model creation

    protected $guard = 'health_institution';

    protected $table = 'health_institutions';

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
     * Scope a query to check if Country Head or Health Institution
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $state
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsHead($query, $state = 1)
    {
        return $query->where('isHead', $state);
    }

    /**
     * The health_institution_profile that belong to the health_institution.
     */
    public function health_institution_profile(){
        return $this->hasOne(HealthInstitutionProfile::class, 'health_institution_id');
    }

    /**
     * The license_subscription that belong to the health_institution.
     */
    public function license_subscription(){
        return $this->hasOne(LicenseSubscription::class, 'health_institution_id');
    }

    /**
     * The diseases that belong to the health_institution.
     */
    public function diseases(){
        return $this->hasMany(Disease::class, 'health_institution_id');
    }

    /**
     * The doctor_profile that belong to the health_institution.
     */
    public function doctor_profile(){
        return $this->hasMany(DoctorProfile::class, 'health_institution_id');
    }

    /**
     * The alert_messages that belong to the health_institution.
     */
    public function alert_messages(){
        return $this->hasMany(AlertMessage::class, 'health_institution_id');
    }
}