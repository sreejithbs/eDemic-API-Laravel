<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserLocationLog;

class UserDiagnosisLog extends Model
{
	protected $table = 'user_diagnosis_logs';

	/**
	 * The user_location_logs that belong to the user_diagnosis_log.
	 */
	// public function user_location_logs(){
	//     return $this->belongsToMany(UserLocationLog::class, 'user_diagnosis_log_id');
	// }
}
