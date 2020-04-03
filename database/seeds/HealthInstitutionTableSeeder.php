<?php

use Illuminate\Database\Seeder;

use App\Models\HealthInstitution;
use App\Models\HealthInstitutionProfile;
use App\Models\LicenseSubscription;

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
        $institution_head->institutionCode = 'HIN0001';
        $institution_head->email = 'countryhead@demo.com';
        $institution_head->password = bcrypt('123456');
        $institution_head->isHead = 1;
        $institution_head->country_id = 1;
        $institution_head->save();

        // $license_subscription = new LicenseSubscription();
        // $license_subscription->feeAmount = '999.00';
        // $license_subscription->startDate = '2020-03-30';
        // $license_subscription->endDate = '2021-03-30';
        // $license_subscription->status = 1;
        // $institution_head->license_subscription()->save($license_subscription);


        $institution = new HealthInstitution();
        $institution->name = 'Demo Hospital Institution';
        $institution->institutionCode = 'HIN0002';
        $institution->email = 'institution@demo.com';
        // $institution->password = bcrypt('123456');
        $institution->password = bcrypt('L7wMgpUh');
        $institution->country_id = $institution_head->country_id;
        $institution->save();

        $institution_profile = new HealthInstitutionProfile();
        $institution_profile->phone = '9219592195';
        $institution_profile->address = 'Pottakuzhy Rd, Pattom, Thiruvananthapuram, Kerala 695004';
        $institution_profile->purchasedDoctorConnects = 0;
        $institution_profile->remainingDoctorConnects = 0;
        $institution->health_institution_profile()->save($institution_profile);

        // $license_subscription = new LicenseSubscription();
        // $license_subscription->feeAmount = '999.00';
        // $license_subscription->startDate = '2020-03-30';
        // $license_subscription->endDate = '2021-03-30';
        // $license_subscription->status = 1;
        // $institution->license_subscription()->save($license_subscription);
    }
}