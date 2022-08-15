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
        ])->assignRole('admin');

        User::create([
            'name' => 'student',
            'password' => bcrypt('12345678'),
            'email' => 'student@pnb.ac.id'
        ])->assignRole('student');

        User::create([
            'name' => 'lecture',
            'password' => bcrypt('12345678'),
            'email' => 'lecture@pnb.ac.id'
        ])->assignRole('lecture');
    }
}
