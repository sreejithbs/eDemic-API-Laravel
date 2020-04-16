<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $diagnosis_logs = UserDiagnosisLog::whereIn('stage', [
            Disease::INFECTION_STATUS, Disease::RECOVERED_STATUS, Disease::DEAD_STATUS,
        ])->with(['user'])->latest('diagnosisDateTime')->get();
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
        $diagnosis_logs = UserDiagnosisLog::where('stage', Disease::SELF_QUARANTINE_STATUS)->with(['user'])->latest('diagnosisDateTime')->get();
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