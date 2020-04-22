<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\HealthInstitution;

class HealthInstitutionProfile extends Model
{
    protected $table = 'health_institution_profiles';

    /**
     * The health_head that belong to the health_institution_profile.
     */
    public function health_head(){
        return $this->belongsTo(HealthInstitution::class, 'head_health_institution_id');
    }
}
