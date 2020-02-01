<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;


class SuscripcionController extends Controller
{
    //
    public function getAll(){
        return Suscripcion::all();
    }

    public function cuentaSuscritos(Request $request){
        //

        $idOferta = $request->query('id_oferta');

        return Suscripcion::where('idoferta', '=', $idOferta)
        ->count();
    }

    public function existeCandidato(Request $request){
        //

        $id = $request->query('id_candidato');
        $idoferta = $request->query('id_oferta');

        return Suscripcion::where('idusuario', '=', $id)
        ->where('idoferta','=',$idoferta)
        ->get();
    }
}
