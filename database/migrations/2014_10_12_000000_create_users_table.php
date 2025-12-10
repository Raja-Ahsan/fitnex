<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('team')->nullable();
            $table->string('gender')->nullable();
            $table->string('top_rated')->nullable();
            $table->string('about_me')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('skype')->Nullable();
            $table->string('facebook')->Nullable();
            $table->string('twitter')->Nullable();
            $table->string('instagram')->Nullable();
            $table->string('behance')->Nullable();
            $table->string('youtube')->Nullable();
            $table->bigInteger('city_id')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->bigInteger('license')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('deleted_at')->nullable();
            $table->string('status')->default(1)->comment('0=inactive, 1= active');
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
        Schema::dropIfExists('users');
    }
}
