<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Auth, DB;
use StringHelper, ConstantHelper;
use QrCode;

use App\Models\DoctorProfile;
use App\Events\DoctorProfileWasCreatedEvent;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:isInstitution');
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = DoctorProfile::latest('id')->get();
        return view('_health_institution.doctor_listing', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $remainingDoctorConnects = Auth::guard('health_institution')->user()->health_institution_profile->remainingDoctorConnects;
        return view('_health_institution.doctor_create', compact('remainingDoctorConnects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        DB::beginTransaction();

        $institution = Auth::guard('health_institution')->user();

        try {
            $doctor = new DoctorProfile();
            $doctor->name = $request->name;
            $doctor->email = $request->email;
            $doctor->phone = $request->phone_number;
            $doctor->health_institution_id = $institution->id;
            $doctor->profileQrCode = "0";  //temporary
            $doctor->save();

            $encode_data = json_encode( array("type" => "doctor", "id" => $doctor->id) );
            $qrCodeName = StringHelper::uniqueSlugString($doctor->name .'-doctor');
            $targetPath = 'storage/qrcodes/'.$qrCodeName.'.png';

            QrCode::format('png')
                ->errorCorrection('H')
                ->color(30, 160, 240)
                ->size(350)
                ->generate($encode_data, public_path($targetPath));

            $doctor->profileQrCode = $targetPath;
            $doctor->save();

            $institution->health_institution_profile()->decrement('remainingDoctorConnects');

            DB::commit();

            // Trigger Mail
            event( new DoctorProfileWasCreatedEvent($doctor) );

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DOCTOR_CREATE_FAIL]);
        }

        return redirect()->route('institution_doctors.list')->with('success', ConstantHelper::DOCTOR_CREATE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $doctor = DoctorProfile::fetchModelByUuId($uuid);
        return view('_health_institution.doctor_edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DoctorRequest  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $doctor = DoctorProfile::fetchModelByUuId($uuid);
            $doctor->name = $request->name;
            $doctor->phone = $request->phone_number;
            $doctor->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DOCTOR_UPDATE_FAIL]);
        }

        return redirect()->route('institution_doctors.list')->with('success', ConstantHelper::DOCTOR_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $institution = Auth::guard('health_institution')->user();
        try {
            $doctor = DoctorProfile::fetchModelByUuId($uuid);
            $doctor->delete();

            $institution->health_institution_profile()->increment('remainingDoctorConnects');

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DOCTOR_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::DOCTOR_DELETE);
    }
}