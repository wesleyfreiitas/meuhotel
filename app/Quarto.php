<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Quarto extends Model
{

    public function reserva(){
        return $this->belongsTo('App\Reserva', 'categoria_id', 'id');
    }
}
