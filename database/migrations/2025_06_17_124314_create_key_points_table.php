<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key_points', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id');
            $table->integer('dayNum');
            $table->string( 'time', 5 );
            $table->string( 'description', 255 )->nullable();
            $table->bigInteger('ms')->nullable();

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
        Schema::dropIfExists('key_points');
    }
}
