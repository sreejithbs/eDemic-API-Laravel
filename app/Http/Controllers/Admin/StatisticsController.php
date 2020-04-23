<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnosis_logs = UserDiagnosisLog::whereRaw('id IN (SELECT MAX(id) FROM user_diagnosis_logs GROUP BY patient_id, disease_id)')
                            ->has('user_location_logs')
                            ->with(['user_location_logs'])
                            ->latest('id')
                            ->get()
                            ->groupBy(['disease_id', function ($item) {
                                return $item['stage'];
                            }], $preserveKeys = false);

        return view('_admin.statistics_listing', compact('diagnosis_logs'));
    }
}