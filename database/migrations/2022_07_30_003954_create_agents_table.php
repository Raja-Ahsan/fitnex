<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->string('slug')->nullable();
            $table->string('name')->Nullable();
            $table->string('designation')->Nullable();
            $table->string('facebook')->Nullable();
            $table->string('twitter')->Nullable();
            $table->string('instagram')->Nullable();
            $table->string('behance')->Nullable();
            $table->string('youtube')->Nullable();
            $table->string('image')->Nullable();
            $table->string('status')->default(1)->comment('0=inactive, 1= active');
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
        Schema::dropIfExists('agents');
    }
}
