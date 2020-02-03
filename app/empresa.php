<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $fillable = [
        'name_reg', 'surname_reg', 'name', 'picture', 'email', 'password', 'secretQ', 
        'secretA', 'phone', 'sector', 'description'
    ];

    protected $hidden = ['password', 'secretA'];

    public function ofertas()
    {
        return $this->hasMany('App\Oferta');
    }

    
}
