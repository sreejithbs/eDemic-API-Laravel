<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;

use App\Models\Disease;
use App\Models\UserDiagnosisLog;

class PatientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:isInstitution')->only(['listQuarantine', 'showQuarantine']);
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->where('stage', Disease::INFECTION_STATUS)
                            ->has('user_location_logs')
                            ->with(['user', 'user_location_logs'])
                            ->latest('id')
                            ->get();

        return view('_health_institution.patient_listing', compact('diagnosis_logs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $diagnosis_log = UserDiagnosisLog::fetchModelByUuId($uuid);
        return view('_health_institution.patient_view', compact('diagnosis_log'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listQuarantine()
    {
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->where('stage', Disease::SELF_QUARANTINE_STATUS)
                            ->has('user_location_logs')
                            ->with(['user', 'user_location_logs'])
                            ->latest('id')
                            ->get();

        return view('_health_institution.quarantine_listing', compact('diagnosis_logs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function showQuarantine($uuid)
    {
        $diagnosis_log = UserDiagnosisLog::fetchModelByUuId($uuid);
        return view('_health_institution.quarantine_view', compact('diagnosis_log'));
    }
}