<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    //
    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }

    public function oferta()
    {
        return $this->belongsTo('App\Oferta','idoferta','id');
    }
}
