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
        $role = Role::create([
            'name' => 'superadmin',
            'label' => 'Superadministrator'
        ]);


        App\User::first()->assignRole($role);

        $admin = Role::create([
            'name' => 'admin',
            'label' => 'Administrator'
        ]);

        $admin->addPermission(App\Permission::first());

        Role::create([
            'name' => 'working_time',
            'label' => 'Arbeitszeiten'
        ]);

    }
}
