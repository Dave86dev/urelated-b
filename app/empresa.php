<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //

    public function ofertas()
    {
        return $this->hasMany('App\Oferta');
    }

    
}
