<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = new User(['username' => 'admin', 'email' => 'admin@example.com', 'password' => 'admin']);
        $adminRole = Role::where('name', 'Administrator')->first();
        $adminUser->save();
        $adminUser->roles()->save($adminRole);
    }
}
