<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\InstitutionRequest;
use Auth, DB;
use ConstantHelper;

use App\Models\HealthInstitution;
use App\Models\HealthInstitutionProfile;

class HealthInstitutionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:isCountryHead');
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $health_institutions = HealthInstitution::where('isHead', 0)->latest()->get();
        return view('_health_institution.institution_listing', compact('health_institutions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_health_institution.institution_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\InstitutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionRequest $request)
    {
        DB::beginTransaction();

        try {
            $institution = new HealthInstitution();
            $institution->name = $request->name;
            $institution->institutionCode = $request->uid;
            $institution->email = $request->email;
            $institution->password = bcrypt($request->password);
            $institution->country_id = Auth::guard('health_institution')->user()->country_id;
            $institution->save();

            $institution_profile = new HealthInstitutionProfile();
            $institution_profile->phone = $request->phone_number;
            $institution_profile->address = $request->address;
            $institution->health_institution_profile()->save($institution_profile);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::INSTITUTION_CREATE_FAIL]);
        }

        return redirect()->route('institution_institutions.list')->with('success', ConstantHelper::INSTITUTION_CREATE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $health_institution = HealthInstitution::fetchModelByUuId($uuid);
        return view('_health_institution.institution_edit', compact('health_institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\InstitutionRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionRequest $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $institution = HealthInstitution::fetchModelByUuId($uuid);
            $institution->name = $request->name;
            $institution->save();

            $institution->health_institution_profile->phone = $request->phone_number;
            $institution->health_institution_profile->address = $request->address;
            $institution->health_institution_profile->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::INSTITUTION_UPDATE_FAIL]);
        }

        return redirect()->route('institution_institutions.list')->with('success', ConstantHelper::INSTITUTION_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try{
            $institution = HealthInstitution::fetchModelByUuId($uuid);
            $institution->delete();

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::INSTITUTION_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::INSTITUTION_DELETE);
    }
}