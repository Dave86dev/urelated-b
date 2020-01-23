<?php

namespace App\Http\Controllers;

use App\Empresa;
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

    // //Puesto, empresa o palabra clave
    // public function getSearch1($param1){
    //     return Oferta::where('titulo', 'LIKE', $param1)
    //     ->orWhere('tipo_contrato', 'LIKE', $param1)
    //     ->orWhere('idempresa', 'LIKE', $param1)
    //     ->get();
    // }
    //Puesto, empresa o palabra clave
    // public function getSearch1($param1){
    //     return Oferta::join('ofertas','ofertas.idempresa', '=', 'empresas.id', 'inner', true)
    //     ->where('titulo', 'LIKE', $param1)
    //     ->orWhere('tipo_contrato', 'LIKE', $param1)
    //     ->orWhere('idempresa', 'LIKE', $param1)
    //     ->orWhere('empresas.name', 'LIKE', $param1)
    //     ->get();
    // }

    // public function getSearchOk($param1){
    //     return Oferta::with(["empresa" => function($q ) use ($param1){
    //         $q->where('empresas.name', 'LIKE', $param1);
    //     }])->get();
    // }
}
 
// Route::get('/ofertas/{userId}', function ($userId)
//     {
//         return App\Usuario::find($userId)->load('suscripciones.oferta');
//     });