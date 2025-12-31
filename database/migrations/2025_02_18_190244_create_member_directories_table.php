<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_directories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->json('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable(); 
            $table->string('address')->nullable();
            $table->string('url')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('hear_about_us')->nullable();
            $table->string('image')->nullable();
            $table->string('rejection_reason')->nullable();
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
        Schema::dropIfExists('member_directories');
    }
}
