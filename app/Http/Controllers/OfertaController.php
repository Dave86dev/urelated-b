<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;

class OfertaController extends Controller
{
    //
    public function getId($salario){
        return Oferta::where('salario','>=',$salario)->get();
    }
}


