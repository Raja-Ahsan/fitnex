<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('created_by'); 
            $table->string('title');  
            $table->string('host');
            $table->date('date');
            $table->time('time');
            $table->time('end_time');
            $table->string('location');
            $table->string('location_link');
            $table->string('registration_link');
            $table->string('status')->default(1)->comment('0=inactive , 1=active');  
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
        Schema::dropIfExists('events');
    }
}
