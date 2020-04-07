<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use Auth, DB;
use ConstantHelper;
// use QrCode;

use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
        $this->middleware('can:isCountryHead')->except(['index', 'triggerPushMessage']);
        $this->middleware('can:hasLicencePurchased');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::latest('id')->get();
        return view('_health_institution.message_listing', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_health_institution.message_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        DB::beginTransaction();

        try {
            $message = new Message();
            $message->title = $request->title;
            $message->content = $request->content;
            $message->health_institution_id = Auth::guard('health_institution')->id();
            $message->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::MESSAGE_CREATE_FAIL]);
        }

        return redirect()->route('institution_messages.list')->with('success', ConstantHelper::MESSAGE_CREATE);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $message = Message::fetchModelByUuId($uuid);
        return view('_health_institution.message_edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MessageRequest  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(MessageRequest $request, $uuid)
    {
        DB::beginTransaction();

        try {
            $message = Message::fetchModelByUuId($uuid);
            $message->title = $request->title;
            $message->content = $request->content;
            $message->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::MESSAGE_UPDATE_FAIL]);
        }

        return redirect()->route('institution_messages.list')->with('success', ConstantHelper::MESSAGE_UPDATE);
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
            $message = Message::fetchModelByUuId($uuid);
            $message->delete();

        } catch (\Exception $e) {
            // return back()->withErrors(['error' => $e->getMessage()]);
            return back()->withErrors(['error' => ConstantHelper::MESSAGE_DELETE_FAIL]);
        }

        return back()->with('success', ConstantHelper::MESSAGE_DELETE);
    }

    // Trigger Android and iOS push message
    public function triggerPushMessage($uuid)
    {
        dd($uuid);
    }
}