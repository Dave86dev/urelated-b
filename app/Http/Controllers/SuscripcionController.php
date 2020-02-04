<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


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

    public function nuevaSuscripcion(Request $request){
        //

        $id_oferta = $request->input('id_oferta');
        $id_candidato = $request->input('id_usuario');
        $date = $request->input('date');
        $estado = 0;

        try {

            return Suscripcion::create(
                [
                    'estado' => $estado,
                    'fecha_sus' => $date,
                    'idusuario' => $id_candidato,
                    'idoferta' => $id_oferta
                ]);


        } catch(QueryException $err) {
             echo ($err);
        }
    }

    public function suscripcionesPorE(Request $request){
        

        $id = $request->query('id_empresa');
        

        return Suscripcion::selectRaw('usuarios.name, usuarios.id, empresas.name, suscripcions.estado, ofertas.titulo, ofertas.fecha_publi, ofertas.salario, ofertas.ciudad')
        ->join('usuarios', 'suscripcions.idusuario', '=', 'usuarios.id')
        ->join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('empresas.id', '=', $id)
        ->get();

        
    }
}

