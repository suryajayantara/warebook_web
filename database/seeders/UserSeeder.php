<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
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
        $userDetails = new UserDetail();
        $user->name = 'Surya Jayantara';
        $user->email = 'suryajayantara@pnb.ac.id';
        $user->password = bcrypt('12345678');
        $user->assignRole('student');
        $user->save();

        $userDetails->users_id = 1;
        $userDetails->unique_id = "1915323025";
        $userDetails->departement_id = 1;
        $userDetails->study_id = 1;

        $userDetails->save();
        
        $user = new User();
        $userDetails = new UserDetail();
        $user->name = 'Arya Candrayana';
        $user->email = 'aryacandrayana@pnb.ac.id';
        $user->password = bcrypt('12345678');
        $user->assignRole('lecture');
        $user->save();

        $userDetails->users_id = 2;
        $userDetails->unique_id = "1915323005";
        $userDetails->departement_id = 1;
        $userDetails->study_id = 1;

        $userDetails->save();

       
    }
}
