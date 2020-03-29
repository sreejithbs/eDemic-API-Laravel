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

    	DB::table('countries')->insert([
    		array('name' => 'India', 'isoCode' => 'IN'),
    		array('name' => 'United States of America', 'isoCode' => 'US'),
    		array('name' => 'United Kingdom', 'isoCode' => 'UK'),
    	]);

    	$this->call(HealthInstitutionTableSeeder::class);
    }
}
