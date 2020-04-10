<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserDiagnosisLog;
use App\Models\UserLocationLog;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->userCode = 'UxYUs3Fj';
        $user->phone = '+919219592195';
        $user->androidDeviceId = '9c74d56d682e549c';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'IN')->value('id');
        $user->save();

        // One
        $diagnosis_log = new UserDiagnosisLog();
        // $diagnosis_log->doctor_id = 1;
        $diagnosis_log->disease_id = 1;
        $diagnosis_log->diagnosisDateTime = Carbon::now()->subDays(1);
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->user_diagnosis_log_id = $diagnosis_log->id;
        $location_log->reportedDateTime = Carbon::now()->subDays(1);
        $location_log->latitude = '53.0';
        $location_log->longitude = '-1.4';
        $location_log->save();

        $location_log = new UserLocationLog();
        $location_log->user_diagnosis_log_id = $diagnosis_log->id;
        $location_log->reportedDateTime = Carbon::now();
        $location_log->latitude = '54.0';
        $location_log->longitude = '-1.2';
        $location_log->save();

        // Two
        $diagnosis_log = new UserDiagnosisLog();
        // $diagnosis_log->doctor_id = 1;
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now()->addDays(1);
        $diagnosis_log->stage = 2;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->user_diagnosis_log_id = $diagnosis_log->id;
        $location_log->reportedDateTime = Carbon::now()->addDays(1);
        $location_log->latitude = '55.0';
        $location_log->longitude = '-1.0';
        $location_log->save();
    }
}