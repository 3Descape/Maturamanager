<?php

use Illuminate\Database\Seeder;
use App\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'admin',
            'label' => 'Ist Administrator'
        ]);

        Permission::create([
            'name' => 'working_time',
            'label' => 'Arbeitszeiten verwalten und bestädigen'
        ]);

        Permission::create([
            'name' => 'user',
            'label' => 'Kann Nutzer verwalten'
        ]);

        Permission::create([
            'name' => 'cleanupPerson',
            'label' => 'Aufräumdienst'
        ]);
    }
}
