<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospedes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('rg')->nullable();
            $table->string('cpf');
            $table->string('email')->unique();
            $table->date('nascimento')->nullable();
            $table->string('telefone')->nullable();
            $table->string('estado');
            $table->string('cidade');
            $table->string('rua');
            $table->string('bairro');
            $table->string('cep');
            $table->string('complemento')->nullable();
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
        Schema::dropIfExists('hospedes');
    }
}
