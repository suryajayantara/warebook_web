<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating Dummy User
        $user = new User();
        $user->name = 'Surya Jayantara';
        $user->email = 'suryajayantara@pnb.ac.id';
        $user->password = bcrypt('12345678');

        $user->save();
    }
}
