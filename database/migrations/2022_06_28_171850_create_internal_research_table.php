<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_research', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('abstract');
            $table->string('budget_type');
            $table->bigInteger('budget');
            $table->dateTime('project_started_at');
            $table->dateTime('project_finish_at');
            $table->string('contract_number');
            $table->text('team_member');
            $table->string('file_name_doc');
            $table->string('file_name_prop');
            $table->text('proposal_url');
            $table->text('document_url');
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
        Schema::dropIfExists('internal_research');
    }
}
