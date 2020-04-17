<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HealthHeadRequest;
use DB;
use ConstantHelper;

use App\Models\HealthInstitution;
use App\Events\HealthInstitutionWasCreatedEvent;

class HealthHeadController extends Controller
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
        $health_heads = HealthInstitution::isHead(1)->latest('id')->get();
        return view('_admin.health_head_listing', compact('health_heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('_admin.health_head_create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\HealthHeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HealthHeadRequest $request)
    {
        DB::beginTransaction();

        try {
            $health_head = new HealthInstitution();
            $health_head->name = $request->name;
            $health_head->institutionCode = $request->uid;
            $health_head->email = $request->email;
            $health_head->password = bcrypt($request->password);
            $health_head->isHead = 1;
            $health_head->country_id = (int)$request->country;
            $health_head->save();

            DB::commit();

            // Trigger Mail
            event( new HealthInstitutionWasCreatedEvent($health_head, $request->password) );

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::HEALTH_HEAD_CREATE_FAIL]);
        }

        return redirect()->route('admin_health_heads.list')->with('success', ConstantHelper::HEALTH_HEAD_CREATE);
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
            $health_head = HealthInstitution::fetchModelByUuId($uuid);
            $health_head->delete();

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::HEALTH_HEAD_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::HEALTH_HEAD_DELETE);
    }

    /**
     * Activate or Deactivate Health Heads
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($uuid)
    {
        $health_head = HealthInstitution::fetchModelByUuId($uuid);
        $health_head->isActive = !$health_head->isActive;
        $health_head->save();

        return back()->with('success', ConstantHelper::HEALTH_HEAD_TOGGLE_STATUS);
    }
}