<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    public function hospede(){
        return $this->belongsTo('App\Hospede', 'hospede_id', 'id');
    }

    public function quarto(){
        return $this->belongsTo('App\Quarto', 'quarto_id', 'id');
    }
}
