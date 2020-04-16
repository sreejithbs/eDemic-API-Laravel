<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiseaseRequest;
use Auth, DB;
use StringHelper, ConstantHelper;
use QrCode;

use App\Models\Disease;
use App\Events\DiseaseWasCreatedEvent;

class DiseaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:isCountryHead')->except(['index']);
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases = Disease::latest('id')->get();
        return view('_health_institution.disease_listing', compact('diseases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_health_institution.disease_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DiseaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiseaseRequest $request)
    {
        $user = Auth::guard('health_institution')->user();

        DB::beginTransaction();

        try {
            $disease = new Disease();
            $disease->name = $request->name;
            $disease->diseaseCode = $request->code;
            $disease->riskLevel = $request->risk_level;
            $user->diseases()->save($disease);

            $id_code = $disease->id + 6000;
            $stages = array(
                array( 'code' => 5001, 'name' => Disease::INFECTION, 'color' => array(255, 0, 0) ),
                array( 'code' => 5002, 'name' => Disease::RECOVERED, 'color' => array(0, 255, 0) ),
                array( 'code' => 5003, 'name' => Disease::DEAD, 'color' => array(0, 0, 0) ),
                array( 'code' => 5004, 'name' => Disease::SELF_QUARANTINE, 'color' => array(255, 165, 0) )
            );

            foreach ($stages as $key => $stage)
            {
                $encode_data = json_encode( array("type" => "disease", "id_code" => $id_code, "stage_code" => $stage['code']) );
                $qrCodeName = StringHelper::uniqueSlugString($disease->name .'-'. $stage['name']);
                $targetPath = 'storage/qrcodes/'.$qrCodeName.'.png';

                QrCode::format('png')
                    ->errorCorrection('H')
                    ->color($stage['color'][0], $stage['color'][1], $stage['color'][2])
                    ->size(350)
                    ->generate($encode_data, public_path($targetPath));

                $disease->{$stage['name'].'QrCode'} = $targetPath;
            }
            $disease->save();

            DB::commit();

            // Trigger Mail
            event( new DiseaseWasCreatedEvent($disease) );

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DISEASE_CREATE_FAIL]);
        }

        return redirect()->route('institution_diseases.list')->with('success', ConstantHelper::DISEASE_CREATE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $disease = Disease::fetchModelByUuId($uuid);
        return view('_health_institution.disease_edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\DiseaseRequest  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(DiseaseRequest $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $disease = Disease::fetchModelByUuId($uuid);
            $disease->name = $request->name;
            $disease->riskLevel = $request->risk_level;
            $disease->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DISEASE_UPDATE_FAIL]);
        }

        return redirect()->route('institution_diseases.list')->with('success', ConstantHelper::DISEASE_UPDATE);
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
            $disease = Disease::fetchModelByUuId($uuid);
            $disease->delete();

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DISEASE_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::DISEASE_DELETE);
    }

    /**
     * Display a listing of the diseases and risk levels.
     *
     * @return \Illuminate\Http\Response
     */
    public function editRiskLevel()
    {
        $diseases = Disease::latest('id')->get();
        return view('_health_institution.disease_risk_level', compact('diseases'));
    }

    // AJAX : Fetch disease risk level
    public function fetchRiskLevel(Request $request)
    {
        if($request->ajax()){
            $disease = Disease::fetchModelByUuId($request->disease);
            return response()->json(['status' => TRUE, 'level' => $disease->riskLevel]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DiseaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRiskLevel(DiseaseRequest $request)
    {
        DB::beginTransaction();

        try {
            $disease = Disease::fetchModelByUuId($request->disease);
            $disease->riskLevel = $request->risk_level;
            $disease->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::DISEASE_UPDATE_FAIL]);
        }

        return back()->with('success', ConstantHelper::DISEASE_UPDATE);
    }
}