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
            $table->foreignId('journal_topics_id')->constrained('journal_topics')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('author');
            $table->text('abstract');
            $table->year('year');
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
        Schema::dropIfExists('journal_documents');
    }
}
