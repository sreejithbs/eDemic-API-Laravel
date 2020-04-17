<?php

use Illuminate\Database\Seeder;

use App\Models\HealthInstitution;
use App\Models\HealthInstitutionProfile;
use App\Models\LicenseSubscription;
use App\Models\Payment;

class HealthInstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institution_head = new HealthInstitution();
        $institution_head->name = 'Demo Country Head';
        $institution_head->institutionCode = 'CHHpqa3x';
        $institution_head->email = 'countryhead@demo.com';
        $institution_head->password = bcrypt('123456');
        $institution_head->isHead = 1;
        $institution_head->country_id = DB::table('countries')->where('isoAlphaCode', 'IN')->value('id');
        $institution_head->save();

        $license_subscription = new LicenseSubscription();
        $license_subscription->startDate = '2020-03-30';
        $license_subscription->endDate = '2021-03-30';
        $license_subscription->status = 1;
        $institution_head->license_subscription()->save($license_subscription);

        $payment = new Payment();
        $payment->health_institution_id = $institution_head->id;
        $payment->amount = '999.00';
        $payment->remarks = 'Health Head License Purchase';
        $payment->save();


        $institution = new HealthInstitution();
        $institution->name = 'Cosmo Hospital Institution';
        $institution->institutionCode = 'HIN53xOp';
        $institution->email = 'institution@demo.com';
        // $institution->password = bcrypt('123456');
        $institution->password = bcrypt('L7wMgpUh');
        $institution->country_id = $institution_head->country_id;
        $institution->save();

        $institution_profile = new HealthInstitutionProfile();
        $institution_profile->head_health_institution_id = $institution_head->id;
        $institution_profile->phone = '9219592195';
        $institution_profile->address = 'Pottakuzhy Rd, Pattom, Thiruvananthapuram, Kerala, India 695004';
        $institution_profile->purchasedDoctorConnects = 2;
        $institution_profile->remainingDoctorConnects = 2;
        $institution->health_institution_profile()->save($institution_profile);

        $license_subscription = new LicenseSubscription();
        $license_subscription->startDate = '2020-03-30';
        $license_subscription->endDate = '2021-03-30';
        $license_subscription->status = 1;
        $institution->license_subscription()->save($license_subscription);

        $payment = new Payment();
        $payment->health_institution_id = $institution->id;
        $payment->amount = '1099.00';
        $payment->remarks = 'Health Institution License and Doctor Connects Purchase';
        $payment->save();
    }
}