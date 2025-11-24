<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventLinkedFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_linked_file', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id');
            $table->bigInteger('event_id');
            $table->string( 'name', 255 );
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
        Schema::dropIfExists('event_linked_file');
    }
}
