<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\Models\LicenseSubscription;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:health_institution');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('_health_institution.dashboard');
    }

    /**
     * Licence Purchase Checkout Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createCheckout()
    {
        return view('_health_institution.licence_checkout');
    }

    /**
     * Licence Purchase Checkout Store
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCheckout(Request $request)
    {
        $institution = Auth::guard('health_institution')->user();

        $license_subscription = new LicenseSubscription();
        $license_subscription->feeAmount = $request->feeAmount;
        $license_subscription->startDate = Carbon::now()->format('Y-m-d');
        $license_subscription->endDate = Carbon::now()->addYear()->format('Y-m-d');
        $license_subscription->status = 1;
        $institution->license_subscription()->save($license_subscription);

        if( $request->has('purchasedDoctorConnects') ){
            $institution->health_institution_profile()->increment('purchasedDoctorConnects', $request->purchasedDoctorConnects);
            // $institution->health_institution_profile()->save();
        }

        return redirect()->route('institution_dashboard.show')->with('success', 'Institution Licence has been purchased successfully');
    }
}