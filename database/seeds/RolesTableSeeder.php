<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'label' => 'Administrator'
        ]);

        $role = Role::create([
            'name' => 'superadmin',
            'label' => 'Superadministrator'
        ]);

        App\User::first()->assignRole($role);
    }
}
