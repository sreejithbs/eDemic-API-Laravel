<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\DiseaseRequest;
use DB;
use StringHelper, ConstantHelper;
use QrCode;

use App\Models\Disease;

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
        DB::beginTransaction();

        try {
            $disease = new Disease();
            $disease->name = $request->name;
            $disease->diseaseCode = $request->code;
            $disease->riskLevel = $request->risk_level;
            $disease->save();

            $stages = array(
                'infection' => array(255, 0, 0),
                'recovered' => array(0, 255, 0),
                'dead' => array(0, 0, 0),
                'selfQuarantine' => array(255, 165, 0),
            );

            foreach ($stages as $stage => $color)
            {
                $encode_data = json_encode( array("id" => $disease->id, "stage" => $stage) );
                $qrCodeName = StringHelper::uniqueSlugString($disease->name .'-'. $stage);
                $targetPath = 'storage/qrcodes/'.$qrCodeName.'.png';

                QrCode::format('png')
                    ->errorCorrection('H')
                    ->color($color[0], $color[1], $color[2])
                    ->size(350)
                    ->generate($encode_data, public_path($targetPath));

                $disease->{$stage.'QrCode'} = $targetPath;
            }
            $disease->save();

            DB::commit();

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
}