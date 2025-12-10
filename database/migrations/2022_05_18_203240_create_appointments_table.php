<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('trainer_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('google_calendar_event_id')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('time_zone');
            $table->decimal('price', 8, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->text('description')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('stripe_session_id')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
