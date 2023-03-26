<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function categoria(){
        //Assim eu digo ao laravel que ele deve buscar um endereco na tabela endereco
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
        /*Após adicionar o modelo, vou identificar o id na tabela endereco e em
        seguida o id da tabela cliente.*/
    }
}
