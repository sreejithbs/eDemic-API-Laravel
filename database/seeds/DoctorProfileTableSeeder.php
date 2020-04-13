<?php

use Illuminate\Database\Seeder;

use App\Models\DoctorProfile;

class DoctorProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctor = new DoctorProfile();
        $doctor->health_institution_id = 2;
        $doctor->name = 'John Abraham';
        $doctor->email = 'john@doctor.com';
        $doctor->phone = '+918282828282';
        $doctor->profileQrCode = 'demo/john_abraham_doctor_1586752345.png';
        $doctor->save();
    }
}