<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $working_ticket = factory(App\WorkingTicket::class)->create(['user_id' => 1]);

        $user = App\User::create([
            'name' => 'michael lackner',
            'slug' => 'michael-lackner',
            'email' => 'miclack30@gmail.com',
            'password' => bcrypt('121212'),
        ]);

        // factory(App\User::class, 6)->create()->each(function($u) use($working_ticket){
        //     $u->working_tickets()->save($working_ticket);
        // });
        //
        // $user->working_tickets()->save($working_ticket);
        //
        // factory(App\WorkingTicket::class, 5)->create(['user_id' => 1])->each(function($t) use ($user){
        //     $user->working_tickets()->save($t);
        // });
        //
        // factory(App\User::class, 10)->create()->each(function ($u){
        //     $u->working_tickets()->save(factory(App\WorkingTicket::class)->create(['user_id' => $u->id]));
        // });
    }
}
