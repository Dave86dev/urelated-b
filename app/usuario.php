<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $fillable = [
        'email', 'picture', 'phone', 'password', 'secretQ', 'secretA', 'ciudad', 'provincia',
        'pais', 'name', 'surname'
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
