<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use Auth, DB;
use StringHelper, ConstantHelper;
use QrCode;

use App\Models\User;
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
        $doctors = User::where('isDoctor', 1)->whereHas('doctor_profile', function($q){
            $q->where('health_institution_id', '=', 2);
        })->get();

        return view('_health_institution.doctor_listing', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_health_institution.doctor_create');
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

        try {
            $doctor = new User();
            $doctor->userCode = $request->code;
            $doctor->phone = $request->phone_number;
            $doctor->isDoctor = 1;
            $doctor->save();

            $profile = new DoctorProfile();
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->health_institution_id = Auth::guard('health_institution')->id();
            $profile->profileQrCode = "-";  //temporary
            $doctor->doctor_profile()->save($profile);

            $encode_data = json_encode( array("id" => $doctor->id, "profile_id" => $profile->id, "health_institution_id" => $profile->health_institution_id) );
            $qrCodeName = StringHelper::uniqueSlugString($profile->name .'-profile');
            $targetPath = 'storage/qrcodes/'.$qrCodeName.'.png';

            QrCode::format('png')
                ->errorCorrection('H')
                ->color(30, 160, 240)
                ->size(350)
                ->generate($encode_data, public_path($targetPath));

            $profile->profileQrCode = $targetPath;
            $profile->save();

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
        $doctor = User::fetchModelByUuId($uuid);
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
            $doctor = User::fetchModelByUuId($uuid);
            $doctor->phone = $request->phone_number;
            $doctor->save();

            $doctor->doctor_profile->name = $request->name;
            $doctor->doctor_profile->save();

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
        try{
            $doctor = User::fetchModelByUuId($uuid);
            $doctor->delete();

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DOCTOR_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::DOCTOR_DELETE);
    }
}