<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use ConstantHelper;

use App\Models\HealthInstitution;

class HealthInstitutionController extends Controller
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
        $health_institutions = HealthInstitution::isHead(0)->latest('id')->get();
        return view('_admin.institution_listing', compact('health_institutions'));
    }

    /**
     * Activate or Deactivate Health Heads
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($uuid)
    {
        $health_institution = HealthInstitution::fetchModelByUuId($uuid);
        $health_institution->isActive = !$health_institution->isActive;
        $health_institution->save();

        return back()->with('success', ConstantHelper::HEALTH_INSTITUTION_TOGGLE_STATUS);
    }
}