<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Oferta;
use App\Suscripcion;
use Illuminate\Database\QueryException;

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

        /*$subquery = Login::select('logins.id') 
        ->whereColumn('logins.user_id', 'users.id') 
        ->latest() 
        ->limit(1); 
 
    $query->addSelect(['last_login_id' => $subquery]);
 
    $query->with('last_login'); */
        
    
        
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

    //Ofertas por id de empresa y filtros
    public function getOfertasPorEmp(Request $request){
        //id activas orden estado keyword
        
        $id = $request->query('id');
        $activas = $request->query('activas');
        $orden = $request->query('orden');
        $estado = $request->query('estado');
        $keyword = $request->query('keyword');

        return Oferta::select ('*')
        ->when($activas, function ($query, $activas) {
            return $query->where('isActive', '=', $activas);
        })
        ->when($orden, function ($query, $orden) {
            return $query->orderBy('fecha_publi', 'DESC');
        })
        ->when($estado, function ($query, $estado) {
            return $query->where('estado', '=', $estado);
        })
        ->when($keyword, function ($query, $keyword) {
            return $query->where('desc_general', 'LIKE', "%{$keyword}%");
        })
        ->where('idempresa', '=',$id)
        ->get();
    }

    public function getsearchHome(Request $request){
        
        $puesto = $request->query('puesto');
        $lugar = $request->query('lugar');
        $salario = $request->query('salario');
        $experiencia = $request->query('experiencia');
        $jornada = $request->query('jornada');
        $keyWord = $request->query('keyWord');

        
        return Oferta::selectRaw('ofertas.* , empresas.name, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->when($puesto, function ($query, $puesto) {
            $query->where('titulo', 'LIKE', $puesto);
        })
        ->when($salario, function ($query, $salario) {
            $query->where('salario', '>=', $salario);
        })
        ->when($experiencia, function ($query, $experiencia) {
            $query->where('exp_requerida', '=', $experiencia);
        })
        ->when($jornada, function ($query, $jornada) {
            $query->where('tipo_contrato', 'LIKE', $jornada);
        })
        ->when($lugar, function ($query, $lugar) {
            $query->where('ciudad', 'LIKE', $lugar);
        })
        ->when($keyWord, function ($query, $keyword) {
            $query->where('desc_general', 'LIKE', "%{$keyword}%");
        })
        ->orderBy('fecha_publi', 'DESC')
        ->limit(12)
        ->get();
        
    }

    public function newOferta(Request $request){

        $idEmpresa = $request->input('idEmpresa');
        $titulo = $request->input('titulo');
        $ciudad = $request->input('ciudad');
        $salario = $request->input('salario');
        $sector = $request->input('sector');
        $vacantes = $request->input('vacantes');
        $experiencia = $request->input('experiencia');
        $jornada = $request->input('jornada');
        $descripcion = $request->input('descripcion');
        $fecha = $request->input('fecha');
        $estado = 0;
        $activo = 1;

        try {

            return Oferta::create(
                [
                    'titulo' => $titulo,
                    'ciudad' => $ciudad,
                    'isActive' => $activo,
                    'estado' => $estado,
                    'fecha_publi' => $fecha,
                    'exp_requerida' => $experiencia,
                    'tipo_contrato' => $jornada,
                    'salario' => $salario,
                    'sector' => $sector,
                    'num_vacantes' => $vacantes,
                    'desc_general' => $descripcion,
                    'idempresa' => $idEmpresa
                ]);


        } catch(QueryException $err) {
             echo ($err);
        }
        

    }
}
