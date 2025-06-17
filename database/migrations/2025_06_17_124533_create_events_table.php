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

            $table->bigInteger('company_id');
            $table->bigInteger('category_id')->nullable();
            $table->string( 'name', 255 );
            $table->string( 'notes', 255 )->nullable();
            $table->string( 'type', 255 );
            $table->string( 'durationTime', 10 )->default( '00:00:00' );

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
