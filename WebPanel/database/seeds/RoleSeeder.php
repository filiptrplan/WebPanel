<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $admin = new Role(['name' => 'Administrator', 'access_level' => 100]);
    $admin->save();
    $basic = new Role(['name' => 'Basic User', 'access_level' => 1]);
    $basic->save();
    $premium = new Role(['name' => 'Premium', 'access_level' => 5]);
    $premium->save();
}
}
