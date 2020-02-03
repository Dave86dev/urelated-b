<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    //
    protected $fillable = ['estado', 'fecha_sus', 'idusuario', 'idoferta'];

    public function usuario()
    {
        return $this->belongsTo('App\Usuario','idusuario','id');
    }

    public function oferta()
    {
        return $this->belongsTo('App\Oferta','idoferta','id');
    }
}
