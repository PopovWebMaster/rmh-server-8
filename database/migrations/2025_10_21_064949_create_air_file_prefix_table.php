<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirFilePrefixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_file_prefix', function (Blueprint $table) {
            $table->id();
            $table->string( 'prefix', 60 );
            $table->bigInteger('company_id');
            $table->bigInteger('event_id');
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
        Schema::dropIfExists('air_file_prefix');
    }
}
