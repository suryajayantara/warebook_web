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
        Departement::create([
            'departement_name' => 'Teknik Mesin',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);
        Departement::create([
            'departement_name' => 'Teknik Sipil',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);
        Departement::create([
            'departement_name' => 'Administrasi Niaga',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);
        Departement::create([
            'departement_name' => 'Akuntansi',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);
        Departement::create([
            'departement_name' => 'Pariwisata',
            'desc' => 'Jurusan yang ada di politeknik Negeri Bali'
        ]);

        // Teknik Elektro
        Study::create([
            'departement_id' => 1,
            'studies_name' => 'D3 Manajemen Informatika',
            'desc' => 'Prodi D3 Manajemen Informatika !'
        ]);
        Study::create([
            'departement_id' => 1,
            'studies_name' => 'D4 Teknologi Rekayasa Perangkat Lunak',
            'desc' => 'Prodi D4 Teknologi Rekayasa Perangkat Lunak !'
        ]);
        Study::create([
            'departement_id' => 1,
            'studies_name' => 'Sarjana (S1) Terapan Teknik Otomasi',
            'desc' => 'Prodi Sarjana (S1) Terapan Teknik Otomasi !'
        ]);
        Study::create([
            'departement_id' => 1,
            'studies_name' => 'D3 Teknik Listrik',
            'desc' => 'Prodi D3 Teknik Listrik !'
        ]);


        //Teknik Mesin
        Study::create([
            'departement_id' => 2,
            'studies_name' => 'D3 Teknik Mesin',
            'desc' => 'Prodi D3 Teknik Mesin !'
        ]);
        Study::create([
            'departement_id' => 2,
            'studies_name' => 'D3 Teknik Pendingin & Tata Udara',
            'desc' => 'Prodi D3 Teknik Pendingin & Tata Udara !'
        ]);
        Study::create([
            'departement_id' => 2,
            'studies_name' => 'Sarjana (S1) Terapan  Teknologi Rekayasa Utilitas Mekanikal Elektrikal Plumbing',
            'desc' => 'Prodi Sarjana (S1) Terapan  Teknologi Rekayasa Utilitas Mekanikal Elektrikal Plumbing !'
        ]);


        // Teknik Sipil
        Study::create([
            'departement_id' => 3,
            'studies_name' => 'D3 Teknik Sipil',
            'desc' => 'Prodi D3 Teknik Sipil !'
        ]);
        Study::create([
            'departement_id' => 3,
            'studies_name' => 'D4 Manajemen Proyek Konstruksi',
            'desc' => 'Prodi D4 Manajemen Proyek Konstruksi !'
        ]);

        
        // Administrasi Niaga
        Study::create([
            'departement_id' => 4,
            'studies_name' => 'S1 Terapan Manajemen Bisnis Internasional',
            'desc' => 'Prodi S1 Terapan Manajemen Bisnis Internasional !'
        ]);
        Study::create([
            'departement_id' => 4,
            'studies_name' => 'D3 Adminitrasi Bisnis',
            'desc' => 'Prodi D3 Adminitrasi Bisnis !'
        ]);
        Study::create([
            'departement_id' => 4,
            'studies_name' => 'S1 Terapan Bisnis Digital',
            'desc' => 'Prodi S1 Terapan Bisnis Digital !'
        ]);

        // Akuntansi
        Study::create([
            'departement_id' => 5,
            'studies_name' => 'D3 Akuntansi',
            'desc' => 'Prodi D3 Akuntansi !'
        ]);
        Study::create([
            'departement_id' => 5,
            'studies_name' => 'Sarjana Terapan (D4) Akuntansi Manajerial',
            'desc' => 'Prodi Sarjana Terapan (D4) Akuntansi Manajerial !'
        ]);
        Study::create([
            'departement_id' => 5,
            'studies_name' => 'Sarjana Terapan (D4) Akuntansi Perpajakan',
            'desc' => 'Prodi Sarjana Terapan (D4) Akuntansi Perpajakan !'
        ]);


        //Pariwisata
        Study::create([
            'departement_id' => 6,
            'studies_name' => 'D3 Usaha Perjalanan Wisata',
            'desc' => 'Prodi D3 Usaha Perjalanan Wisata !'
        ]);
        Study::create([
            'departement_id' => 6,
            'studies_name' => 'D3 Perhotelan',
            'desc' => 'Prodi D3 Perhotelan !'
        ]);
        Study::create([
            'departement_id' => 6,
            'studies_name' => 'D4 Manajemen Bisnis Pariwisata',
            'desc' => 'Prodi D4 Manajemen Bisnis Pariwisata !'
        ]);
        Study::create([
            'departement_id' => 6,
            'studies_name' => 'S2 Perencanaan Pariwisata',
            'desc' => 'Prodi S2 Perencanaan Pariwisata !'
        ]);
    }
}
