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

    public function getPuesto($titulo){
        return Oferta::where('titulo', 'LIKE', "%$titulo%")->get();
    }

    public function getCiudad($ciudad){
        return Oferta::where('ciudad', 'LIKE', $ciudad)->get();
    }

    public function getSector($sector){
        return Oferta::where('sector', 'LIKE', $sector)->get();
    }

    //Ciudad o Provincia
    public function getCiudadProvincia($param1){
        return Oferta::where('ciudad', 'LIKE', $param1)
        ->orWhere('provincia', 'LIKE', $param1)
        ->get();
    }
}


/*$libros = DB::table('books')
	->where('author', '=', 'Mario Puzo')
	->orWhere('author', '=', 'Cervantes')
	->get();*/ 