<?php

namespace Database\Seeders;

use App\Models\ThesisDocument;
use Illuminate\Database\Seeder;

class ThesisDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //
        $thesisDocument = new ThesisDocument();

        $thesisDocument->thesis_id = 1;
        $thesisDocument->document_name = 'Bab 1';
        $thesisDocument->file_name = 'Bab 1';
        $thesisDocument->document_url = 'google.com';

        $thesisDocument->save();
    }
}
