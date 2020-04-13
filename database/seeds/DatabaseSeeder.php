<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(AdminTableSeeder::class);
    	$this->call(CountriesTableSeeder::class);
        $this->call(HealthInstitutionTableSeeder::class);
        $this->call(DiseaseTableSeeder::class);
        $this->call(DoctorProfileTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(MessageTableSeeder::class);
    }
}