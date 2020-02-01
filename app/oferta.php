<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //
    protected $fillable = [
        'titulo', 'ciudad', 'isActive', 'estado', 'fecha_publi', 'exp_requerida', 'tipo_contrato', 
        'salario', 'sector', 'num_vacantes', 'desc_general', 'idempresa'
    ];


    public function suscripciones()
    {
        return $this->hasMany('App\Suscripcion','idoferta','id');
    }

    public function empresa()
    {
        return $this->belongsTo('App\Empresa','idempresa','id');
    }
}
