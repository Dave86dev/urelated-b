<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //


    public function suscripciones()
    {
        return $this->hasMany('App\Suscripcion','idoferta','id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa','idempresa','id');
    }
}
