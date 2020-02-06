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
        $estado = 1;

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

    public function suscripcionesPorU(Request $request){

        $id = $request->query('id_usuario');
        $estado = $request->query('estado');

        return Suscripcion::selectRaw('usuarios.id, ofertas.id AS idoferta, ofertas.titulo, ofertas.ciudad, ofertas.tipo_contrato, empresas.id AS idempresa, empresas.name, suscripcions.estado, suscripcions.id AS idsuscrip, suscripcions.fecha_sus')
        ->join('usuarios', 'suscripcions.idusuario', '=', 'usuarios.id')
        ->join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('usuarios.id', '=', $id)
        ->when($estado, function ($query, $estado) {
            $query->where('suscripcions.estado', '=', $estado);
        })
        ->get();
    }

    public function suscripcionesPorE(Request $request){
        

        $id = $request->query('id_oferta');
        

        return Suscripcion::selectRaw('usuarios.id, usuarios.name, usuarios.surname, usuarios.ciudad AS usuciudad, suscripcions.id AS idsuscrip, suscripcions.estado, suscripcions.fecha_sus, ofertas.titulo, ofertas.fecha_publi, ofertas.salario, ofertas.ciudad, ofertas.sector')
        ->join('usuarios', 'suscripcions.idusuario', '=', 'usuarios.id')
        ->join('ofertas', 'suscripcions.idoferta', '=', 'ofertas.id')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('ofertas.id', '=', $id)
        ->get();

        
    }

    public function modSuscripcion(Request $request){

        $id_suscripcion = $request->input('id_suscripcion');
        $estado = $request->input('estado');

        return Suscripcion::where ('id', '=', $id_suscripcion)
        ->update(['estado' => $estado]);
    }

    public function delSuscripcion(Request $request){

        $id_suscripcion = $request->query('id_suscripcion');
        
        return Suscripcion::where ('id', '=', $id_suscripcion)
        ->delete();
    }
}

