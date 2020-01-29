<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Oferta;
use App\Suscripcion;

class OfertaController extends Controller
{
    //

    //ofertas default en orden descendente según fecha
    public function getDefault(){
        return Oferta::
        orderBy('fecha_publi', 'DESC')
        ->limit(12)
        ->get();
    }

    //ofertas según salario
    public function getSalario($salario){
        return Oferta::where('salario','>=',$salario)->get();
    }

    //ofertas según contrato
    public function getContrato($tipo_contrato){
        return Oferta::where('tipo_contrato', 'LIKE', $tipo_contrato)->get();
    }

    //ofertas según puesto
    public function getPuesto($titulo){
        return Oferta::where('titulo', 'LIKE', "Director")
        ->orWhere('titulo', 'LIKE', "CEO")
        ->get();
    }

    //oferta según ciudad
    public function getCiudad($ciudad){
        return Oferta::where('ciudad', 'LIKE', $ciudad)->get();
    }

    //oferta según sector
    public function getSector($sector){
        return Oferta::where('sector', 'LIKE', $sector)->get();
    }

    //Oferta según nombre de empresa
    public function getOfertaEmpresaName($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('ofertas.*')
        ->where('name', 'LIKE', $param1)->get();
    }

    //ofertas según el primer parámetro de búsqueda (search home)
    public function getOfertas1($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->get();
    }

    //Ciudad o Provincia (segundo parámetro de búsqueda home)
    public function getCiudadProvincia($param1){
        return Oferta::where('ciudad', 'LIKE', $param1)
        ->orWhere('provincia', 'LIKE', $param1)
        ->get();
    }

    //ofertas por 2 parámetros de búsqueda (search home)
    public function getOfertasBoth($param1, $param2){
        /*
        //$param2 corresponde a la búsqueda de ubicacion

        return Oferta::where('ciudad', 'LIKE', $param1)
        ->orWhere('provincia', 'LIKE', $param1)
        ->get();

        ---------------------------------------------

        $param1 corresponde a la búsqueda de tipo de oferta
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->get();
        */

        $tipoOferta = Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->where('ciudad', 'LIKE', $param2)
        ->orWhere('provincia', 'LIKE', $param2)
        ->get();
        
        
        
        // $ubicacion = orWhere('ciudad', 'LIKE', $param2)
        // ->orWhere('provincia', 'LIKE', $param2)
        // ->get();

        

        return $tipoOferta;
    }

    //Ofertas por id de empresa
    public function getOfertasPorE($idEmpresa){
        return Oferta::select ('*')
        ->where('idempresa', '=',$idEmpresa)
        ->get();
    }

    //Número de usuarios suscritos a una oferta
    public function getOfertasPorENumU($idEmpresa){
        // $suscripcion=Suscripcion::join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        // ->where('idoferta', '=', $idEmpresa);
        // return ['datos'=>$suscripcion->get(),'inscritos'=>$suscripcion
        // ->count ('idusuario')];
        //---------------------------------------------//
       
        // $suscripcion=Suscripcion::join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        // ->where('idoferta', '=', $idOferta)
        // ->where('idempresa', '=', $idEmpresa);

        // $oferta = Oferta::where('idempresa', '=', $idEmpresa);
        // return ['datos'=>$suscripcion->get(),'inscritos'=>$suscripcion
        // ->count ('idusuario')];

        //--------------------------------------------//

        // $suscripcion=Suscripcion::join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        // ->where('idoferta', '=', $idOferta);
        // ->where('idempresa', '=', $idEmpresa);
        // ->groupBy('id');
        

        $ofertas = Oferta::with('suscripciones')->where('idempresa',$idEmpresa)->get();
        foreach ($ofertas as $oferta) {
            $oferta->load('suscripciones');
            $oferta->total_suscritos=count($oferta->suscripciones);
            unset($oferta->suscripciones);
        }
        return ['datos'=>$ofertas];
    }
}

