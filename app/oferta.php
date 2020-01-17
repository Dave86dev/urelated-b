<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //


    public function suscripciones()
    {
        return $this->hasMany('App\Suscripcion');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}
