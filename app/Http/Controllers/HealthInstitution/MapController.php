<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use DB;

use App\Models\UserDiagnosisLog;

class MapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outerArr = array();
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->has('user_location_logs')
                            ->with(['user_location_logs'])
                            ->latest('id')
                            ->get();

        foreach ($diagnosis_logs as $diagnosis_log) {

            $risk_level = $diagnosis_log->disease->riskLevel;
            if( $risk_level == 0) continue;

            $innerArr = array();
            $risk_levelArr = array(1 => 'images/red.png', 2 => 'images/orange.png', 3 => 'images/yellow.png');

            $recent_location_log = $diagnosis_log->user_location_logs()->latest('id')->first();
            $innerArr['lat'] = $recent_location_log->latitude;
            $innerArr['lng'] = $recent_location_log->longitude;
            $innerArr['title'] = $diagnosis_log->disease->name;
            $innerArr['content'] = $diagnosis_log->user->phone;
            $innerArr['color'] = $risk_levelArr[$risk_level];

            $outerArr[] = $innerArr;
        }

        $map_data = json_encode($outerArr);

        return view('_health_institution.map_listing', compact('map_data'));
    }
}