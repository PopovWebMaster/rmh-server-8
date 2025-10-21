<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirFileNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_file_names', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->string( 'name', 120 );
            $table->bigInteger('event_id')->nullable();
            $table->bigInteger('premiere_sec')->nullable();

            // $table->bigInteger('event_id')->nullable();
            // $table->bigInteger('sub_application_id');
            // $table->string( 'description', 255 )->nullable();
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
        Schema::dropIfExists('air_file_names');
    }
}
