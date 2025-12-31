<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Remove duplicate columns from trainers table that exist in users table.
     * These columns will be accessed through the user relationship instead.
     */
    public function up(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            // Remove duplicate columns that exist in users table
            // These will be accessed via trainer->user relationship
            $table->dropColumn([
                'name',           // Use trainer->user->name instead
                'email',          // Use trainer->user->email instead
                'phone',          // Use trainer->user->phone instead
                'image',           // Use trainer->user->image instead
                'designation',     // Use trainer->user->designation instead
                'facebook',        // Use trainer->user->facebook instead
                'twitter',         // Use trainer->user->twitter instead
                'instagram',      // Use trainer->user->instagram instead
                'linkedin',        // Use trainer->user->linkedin instead
                'youtube',         // Use trainer->user->youtube instead
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            // Restore duplicate columns if needed
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('designation')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
        });
    }
};
