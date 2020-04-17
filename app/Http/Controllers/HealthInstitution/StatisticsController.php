<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;

use App\Models\UserDiagnosisLog;

class StatisticsController extends Controller
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
        $diagnosis_logs = UserDiagnosisLog::latest('id')->get()->groupBy(['disease_id', function ($item) {
            return $item['stage'];
        }], $preserveKeys = false);

        return view('_health_institution.statistics_listing', compact('diagnosis_logs'));
    }
}