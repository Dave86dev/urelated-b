<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //

    public function suscripciones()
    {
        return $this->hasMany('App\Suscripcion','idusuario');
        
    }

    public function curriculum()
    {
        return $this->hasOne('App\Curriculum');
    }

    
}
