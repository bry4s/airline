<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TripStaff;
use App\Models\Ticket;
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
        $user = User::factory(9)->create();
        TripStaff::factory(9)->create();
        Ticket::factory(9)->create();
    }
}
