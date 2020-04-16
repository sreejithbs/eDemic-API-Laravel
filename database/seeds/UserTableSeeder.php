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
        // Patient
        $user = new User();
        $user->userCode = 'UxYUs3Fj';
        $user->phone = '+918943406910';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 1;
        $diagnosis_log->diagnosisDateTime = Carbon::now()->subDays(1);
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now()->subDays(1);
        $location_log->latitude = '51.528308';
        $location_log->longitude = '-0.131847';
        $location_log->address = '8-14 Eversholt St, Kings Cross, London NW1 1DG, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.533149';
        $location_log->longitude = '-0.137069';
        $location_log->address = '76 Oakley Square, London NW1 1NH, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UzOPs34j';
        $user->phone = '+448219592198';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 1;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.528390';
        $location_log->longitude = '-0.151886';
        $location_log->address = 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UqOZs34e';
        $user->phone = '+447219592197';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 1;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.528390';
        $location_log->longitude = '-0.151886';
        $location_log->address = 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UpOZsQP67';
        $user->phone = '+446219592196';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.528380';
        $location_log->longitude = '-0.151886';
        $location_log->address = 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UwOZsQP10';
        $user->phone = '+445219592195';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.528380';
        $location_log->longitude = '-0.161886';
        $location_log->address = '17 Outer Cir, Marylebone, London NW1 4RJ, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'GBRws5P10';
        $user->phone = '+444219592194';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 1;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.529380';
        $location_log->longitude = '-0.151886';
        $location_log->address = 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UgRws5Pdr';
        $user->phone = '+443219592193';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.528490';
        $location_log->longitude = '-0.151886';
        $location_log->address = 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'UgRwopr4x';
        $user->phone = '+442219592192';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.557843';
        $location_log->longitude = '-0.115479';
        $location_log->address = '25 Arthur Rd, London N7, UK';
        $diagnosis_log->user_location_logs()->save($location_log);

        // Patient
        $user = new User();
        $user->userCode = 'Uopr4xPdq';
        $user->phone = '+441219592191';
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'GB')->value('id');
        $user->save();

        $diagnosis_log = new UserDiagnosisLog();
        $diagnosis_log->disease_id = 2;
        $diagnosis_log->diagnosisDateTime = Carbon::now();
        $diagnosis_log->stage = 1;
        $user->patients()->save($diagnosis_log);

        $location_log = new UserLocationLog();
        $location_log->dateTime = Carbon::now();
        $location_log->latitude = '51.529374';
        $location_log->longitude = '-0.136748';
        $location_log->address = '43 Cardington St, Kings Cross, London NW1 2LR, UK';
        $diagnosis_log->user_location_logs()->save($location_log);


        // Doctor
        $user = new User();
        $user->userCode = 'UvMroPMD';
        $user->phone = '+449219592199';
        $user->is_doctor_id = 1;
        $user->isVerified = 1;
        $user->country_id = DB::table('countries')->where('isoAlphaCode', 'IN')->value('id');
        $user->save();
    }
}