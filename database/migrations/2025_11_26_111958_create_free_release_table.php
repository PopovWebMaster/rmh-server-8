<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreeReleaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('free_release', function (Blueprint $table) {
            $table->id();

            
            $table->bigInteger('company_id');
            $table->bigInteger('event_id');
            $table->string( 'file_name', 255 );
            $table->integer('duration');


            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('free_release');
    }
}
