<?php

use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'TBA Super-Admin';
        $admin->email = 'superadmin@demo.com';
        $admin->password = bcrypt('123456');
        $admin->save();
    }
}