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
            'name' => 'can_assign_ticket',
            'label' => 'Aufgaben verwalten'
        ]);

        Permission::create([
            'name' => 'can_manage_working_time',
            'label' => 'Arbeitszeit verwalten'
        ]);

        Permission::create([
            'name' => 'can_manage_tickets',
            'label' => 'Verwltung der Tickets'
        ]);
    }
}
