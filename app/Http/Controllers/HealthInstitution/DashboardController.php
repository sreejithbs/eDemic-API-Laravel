<?php

namespace App\Http\Controllers\HealthInstitution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

use App\Models\LicenseSubscription;
use App\Models\Payment;

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
        if(Gate::allows('hasLicencePurchased') && Gate::allows('isCountryHead')){
            return redirect()->route('institution_patients.list');
        } else if(Gate::allows('hasLicencePurchased') && Gate::allows('isInstitution')){
            return redirect()->route('institution_patients.list');
        } else{
            return view('_health_institution.dashboard');
        }
    }

    /**
     * Licence Purchase Checkout Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createCheckout($path)
    {
        if($path == 'licence'){
            return view('_health_institution.licence_checkout');
        } else{
            return view('_health_institution.doctor_checkout');
        }
    }

    /**
     * Licence Purchase Checkout Store
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCheckout(Request $request, $path)
    {
        $institution = Auth::guard('health_institution')->user();

        if($path == 'licence'){
            $license_subscription = new LicenseSubscription();
            $license_subscription->startDate = Carbon::now()->format('Y-m-d');
            $license_subscription->endDate = Carbon::now()->addYear()->format('Y-m-d');
            $license_subscription->status = 1;
            $institution->license_subscription()->save($license_subscription);

            if($institution->isHead == 1){
                $remarks = 'Health Head License Purchase';
            } else{
                $remarks = 'Health Institution License and Doctor Connects Purchase';
            }
        } else{
            $remarks = 'Additional Doctor Connects Purchase';
        }

        $payment = new Payment();
        $payment->health_institution_id = $institution->id;
        $payment->amount = $request->feeAmount;
        $payment->remarks = $remarks;
        $payment->save();

        if( $request->has('purchasedDoctorConnects') ){
            $institution->health_institution_profile()->increment('purchasedDoctorConnects', $request->purchasedDoctorConnects);
            $institution->health_institution_profile()->increment('remainingDoctorConnects', $request->purchasedDoctorConnects);
            // $institution->health_institution_profile()->save();
        }

        if($path == 'licence'){
            return redirect()->route('institution_dashboard.show')->with('success', 'Institution Licence has been purchased successfully');
        } else{
            return redirect()->route('institution_doctors.create')->with('success', 'Doctor connects has been purchased successfully');
        }
    }
}