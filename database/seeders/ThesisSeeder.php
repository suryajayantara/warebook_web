<?php

namespace Database\Seeders;

use App\Models\Thesis;
use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thesis = new Thesis();

        $thesis->users_id = 1;
        $thesis->thumbnail_url = 'www.google.com';
        $thesis->thesis_type = 'Tugas Akhir';
        $thesis->created_year = '2019';
        $thesis->title = 'Pengembangan Perangkat Bergerak berbasis Flutter untuk Pembuatan API';
        $thesis->abstract = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
        $thesis->tags = json_encode(['laravel','new','boys']);

        $thesis->save();
    }
}
