<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MasterAdmin
        User::create([
            'name' => 'Admin',
            'password' => bcrypt('PNBpassword35'),
            'email' => 'politekniknegeribali@pnb.ac.id'
        ])->assignRole('administrator');
    }
}
