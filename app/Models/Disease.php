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

    // Status
    const INFECTION = 'infection';
    const RECOVERED = 'recovered';
    const DEAD = 'dead';
    const SELF_QUARANTINE = 'selfQuarantine';

    const INFECTION_STATUS = 1;
    const RECOVERED_STATUS = 2;
    const DEAD_STATUS = 3;
    const SELF_QUARANTINE_STATUS = 4;

    /**
     * List the fields that would automatically be appended
     *
     * @var array
     */
    protected $appends = ['apiStatusCode'];
    public function getApiStatusCodeAttribute() {
    	return $this->id + 6000;
    }

    /**
     * Fetch all diseases name and status codes
     * @return \Illuminate\Database\Collection
     */
    public static function fetchAllDiseasesApi()
    {
        $diseasesArr = array();
        foreach (self::all() as $disease){
            $diseasesArr[] = array( 'code' => $disease->apiStatusCode, 'uid' => $disease->diseaseCode, 'name' => $disease->name );
        }
    	return array("diseases" => $diseasesArr);
    }

    /**
     * The user_diagnosis_logs that belong to the disease.
     */
    public function user_diagnosis_logs(){
        return $this->hasMany(UserDiagnosisLog::class, 'disease_id');
    }
}
