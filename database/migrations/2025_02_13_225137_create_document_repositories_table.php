<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_repositories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->string('file_name')->nullable();
            $table->bigInteger('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->string('parent_id')->nullable()->comment('0=no parent'); 
            $table->string('size')->nullable();
            $table->string('document_file')->nullable();
            $table->string('status')->default('upcoming')->comment('upcoming, ongoing, completed');
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
        Schema::dropIfExists('document_repositories');
    }
}
