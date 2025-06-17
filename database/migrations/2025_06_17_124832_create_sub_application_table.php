<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_application', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('application_id');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->integer('duration_sec')->nullable();
            $table->string( 'name', 255 )->nullable();
            $table->integer('serial_num')->nullable();
            $table->string( 'air_notes', 255 )->nullable();
            $table->string( 'type', 20 );

            
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
        Schema::dropIfExists('sub_application');
    }
}
