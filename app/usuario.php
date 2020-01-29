<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $fillable = [
        'name','surname','email', 'picture','password', 'secretQ', 'secretA','phone', 'ciudad', 'provincia',
        'pais'
    ];

    public function suscripciones()
    {
        return $this->hasMany('App\Suscripcion','idusuario');
        
    }

    public function curriculum()
    {
        return $this->hasOne('App\Curriculum');
    }

    
}
