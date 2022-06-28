<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Study;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departement::create([
            'departement_name' => 'Teknik Elektro',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);

        Study::create([
            'departement_id' => 1,
            'study_name' => 'D3 Manajemen Informatika'
        ]);
    }
}
