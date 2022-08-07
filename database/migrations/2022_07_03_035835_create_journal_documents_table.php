<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('journal_topics_id')->constrained('journal_topics')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->string('author');
            $table->text('abstract');
            $table->string('year');
            $table->string('tags');
            $table->string('doi')->nullable();
            $table->string('original_url')->nullable();
            $table->string('file_name');
            $table->string('document_url');
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
        Schema::dropIfExists('journal_documents');
    }
}
