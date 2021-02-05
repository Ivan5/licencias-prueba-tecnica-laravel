<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Se define la estuctura de la Bd que se utilizará dentro del proyecto, con el nombre de los parámetros y el tipo de cada uno de ellos
        Schema::create('licencias', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('name');
            $table->string('code');
            $table->integer('vig');
            $table->integer('prod');
            $table->integer('status');
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
        Schema::dropIfExists('licencias');
    }
}
