<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->json('project_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->json('county')->nullable();
            $table->string('company')->nullable();
            $table->string('image')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('poc_name')->nullable();
            $table->string('poc_phone')->nullable();
            $table->string('poc_email')->nullable();
            $table->string('key_links')->nullable();
            $table->string('size')->nullable();
            $table->json('file_names')->nullable();
            $table->json('file_sizes')->nullable();
            $table->string('document_file')->nullable();
            $table->string('status')->default('pending')->comment('pending, approved, rejected');
            $table->string('deleted_at')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
