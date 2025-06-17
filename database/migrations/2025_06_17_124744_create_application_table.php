<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('company_id');
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('manager_id')->nullable();
            $table->string( 'name', 255 );
            $table->integer('num')->nullable();
            $table->string( 'manager_notes', 255 )->nullable();


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
        Schema::dropIfExists('application');
    }
}
