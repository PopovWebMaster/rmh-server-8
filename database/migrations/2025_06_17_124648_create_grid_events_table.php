<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGridEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grid_events', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id');
            $table->integer('day_num');
            $table->boolean('is_a_key_point')->default( false );
            $table->integer('start_time')->nullable();
            $table->integer('duration_time')->nullable();
            $table->bigInteger('event_id')->nullable();
            $table->bigInteger('first_segment_id')->nullable();
            $table->string( 'notes', 255 )->nullable();
            $table->integer('cut_part')->nullable();
            $table->string( 'push_it', 10 )->nullable();

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
        Schema::dropIfExists('grid_events');
    }
}
