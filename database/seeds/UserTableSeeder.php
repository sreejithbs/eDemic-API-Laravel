<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserDiagnosisLog;
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
        $user->userCode = 'U0001';
        $user->phone = '+919219592195';
        $user->save();

        // $user_diagnosis_log = new UserDiagnosisLog();
        // $user_diagnosis_log->doctor_id = ;
        // $user_diagnosis_log->disease_id = ;
        // $user_diagnosis_log->diagnosisDateTime = Carbon::now();
        // $user->patients()->save($user_diagnosis_log);
    }
}