<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = "curriculums";
    protected $fillable = [
        'idusuario', 'isWorking','isWorked_before', 'isEstudios', 'formacion', 'experiencia'
    ];

    public function usuario()
    {
     return $this->belongsTo('App\Usuario', 'idusuario', 'id');
    }
}
