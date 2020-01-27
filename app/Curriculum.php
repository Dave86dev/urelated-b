<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    //

    public function usuario()
    {
        return $this->belongsTo('App\Usuario');
    }
}
