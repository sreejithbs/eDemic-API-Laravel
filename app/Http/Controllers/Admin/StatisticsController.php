<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

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
        $diagnosis_logs = UserDiagnosisLog::latest('id')->get()->groupBy(['disease_id', function ($item) {
            return $item['stage'];
        }], $preserveKeys = false);

        return view('_admin.statistics_listing', compact('diagnosis_logs'));
    }
}