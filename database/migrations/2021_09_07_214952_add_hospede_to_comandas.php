<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHospedeToComandas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comandas', function (Blueprint $table) {
            $table->unsignedBigInteger('hospede_id');
            $table->foreign('hospede_id')->references('id')->on('hospedes');
            //$table->unsignedBigInteger('reserva_id');
            //$table->foreign('reserva_id')->references('id')->on('reservas');
            $table->unsignedBigInteger('quarto_id');
            $table->foreign('quarto_id')->references('id')->on('quartos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comandas', function (Blueprint $table) {
            //
        });
    }
}
