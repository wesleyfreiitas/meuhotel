<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComandas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('desconto')->nullable();
            $table->integer('acrescimo')->nullable();
            $table->integer('total_pagar')->nullable();
            $table->integer('total_pago')->nullable();
            $table->integer('troco')->nullable();
            $table->integer('tipo_pg')->nullable();
            $table->integer('qtd_diaria')->nullable();
            $table->string('status')->nullable();
            $table->datetime('chegada')->nullable();
            $table->datetime('saida')->nullable();
            $table->string('obs')->nullable();
            $table->string('adultos')->nullable();
            $table->string('criancas')->nullable();
            $table->string('situacao')->default('ABERTO');
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
        Schema::dropIfExists('comandas');
    }
}
