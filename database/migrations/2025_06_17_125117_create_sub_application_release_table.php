<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubApplicationReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_application_release', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('sub_application_id');
            $table->bigInteger('grid_event_id')->nullable();
            $table->date('date');
            $table->integer('time_sec');

            
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
        Schema::dropIfExists('sub_application_release');
    }
}
