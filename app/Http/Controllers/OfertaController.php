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

    public function getContrato($tipo_contrato){
        return Oferta::where('tipo_contrato', 'LIKE', $tipo_contrato)->get();
    }

    public function getCiudad($ciudad){
        return Oferta::where('ciudad', 'LIKE', $ciudad)->get();
    }
}


