<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by');
            $table->string("name")->nullable(); 
            $table->string("trainer_type")->nullable();
            $table->string("designation")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable(); 
            $table->string("image")->nullable();  
            $table->string('description')->nullable(); 
            $table->string('price')->nullable(); 
            $table->string('rating')->nullable();
            $table->string('specialization')->nullable(); 
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable(); 
            $table->string('status')->default(1)->comment('0=inactive , 1=active');  
            $table->string('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
