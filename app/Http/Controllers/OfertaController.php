<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;

class OfertaController extends Controller
{
    //

    public function getDefault(){
        return Oferta::
        orderBy('fecha_publi', 'DESC')
        ->limit(12)
        ->get();
    }

    //$results = Project::orderBy('name')->get();

    public function getId($salario){
        return Oferta::where('salario','>=',$salario)->get();
    }

    public function getContrato($tipo_contrato){
        return Oferta::where('tipo_contrato', 'LIKE', $tipo_contrato)->get();
    }

    public function getPuesto($titulo){
        return Oferta::where('titulo', 'LIKE', "Director")
        ->orWhere('titulo', 'LIKE', "CEO")
        ->get();
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

    //Oferta segun nombre de empresa
    public function getOfertaEmpresaName($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('ofertas.*')
        ->where('name', 'LIKE', $param1)->get();
    }

    public function getOfertas1($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->get();
    }
}

