<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_documents', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2022_06_10_153254_create_repository_documents_table.php
            // $table->foreign('idRepository');
            $table->string('title');
            $table->string('desc');
=======
            $table->foreignId('thesis_id')->constrained('theses')->onUpdate('cascade')->onDelete('cascade');
            $table->string('document_name');
>>>>>>> 99fa4374805a19bb8bcd3e6afd25a3c535aaf168:database/migrations/2022_06_24_123920_create_thesis_documents_table.php
            $table->string('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_documents');
    }
}
