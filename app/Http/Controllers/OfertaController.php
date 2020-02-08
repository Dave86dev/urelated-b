<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Oferta;
use App\Suscripcion;
use Illuminate\Database\QueryException;

class OfertaController extends Controller
{

    //Obtener las ofertas en orden descendente por fecha, limitadas a 30 resultados en este caso
    public function getDefault(){
        return Oferta::selectRaw('ofertas.* , empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->orderBy('fecha_publi', 'DESC')
        ->limit(30)
        ->get();
    }

    //Oferta por id, con el nombre y el logo de la empresa
    public function getOfertaId($id){

        return Oferta::selectRaw('ofertas.* , empresas.name, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('ofertas.id', '=', $id)
        ->get();

    }

    //Ofertas segun el salaraio
    public function getSalario($salario){
        return Oferta::selectRaw('ofertas.* , empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('salario','>=',$salario)
        ->get();
    }

    //Ofertas segun el tipo de contrato con la foto de empresa
    public function getContrato($tipo_contrato){
        return Oferta::selectRaw('ofertas.* , empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('tipo_contrato', 'LIKE', $tipo_contrato)
        ->get();
    }

    //Ofertas por puesto (titulo de la oferta), incluyendo foto de empresa
    public function getPuesto($titulo){
        
        return Oferta::selectRaw('ofertas.* , empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('titulo', 'LIKE', "Director")
        ->orWhere('titulo', 'LIKE', "CEO")
        ->get();
    }

    //Ofertas segun la ciudad incluyendo foto de empresa
    public function getCiudad($ciudad){

        return Oferta::selectRaw('ofertas.* , empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('ciudad', 'LIKE', $ciudad)
        ->get();
    }

    //Ofertas segun el sector incluyendo foto de empresa
    public function getSector($sector){

        return Oferta::selectRaw('ofertas.*, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('ofertas.sector', 'LIKE', $sector)
        ->get();
        
    }

    //Oferta por nombre de empresa 
    public function getOfertaEmpresaName($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('ofertas.*')
        ->where('name', 'LIKE', $param1)->get();
    }

    //Ofertas con el primer parametro de busqueda de home (nombre, tipo contrato, puesto)
    public function getOfertas1($param1){
        return Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->get();
    }

    //Ofertas con el segundo parametro de busqueda de home (ciudad o provincia)
    public function getCiudadProvincia($param1){
        return Oferta::where('ciudad', 'LIKE', $param1)
        ->orWhere('provincia', 'LIKE', $param1)
        ->get();
    }

    //Oferats con los dos parametros de busqueda de home
    public function getOfertasBoth($param1, $param2){
        

        $tipoOferta = Oferta::join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->select('*')
        ->where('name', 'LIKE', $param1)
        ->orWhere('tipo_contrato', 'LIKE', $param1)
        ->orWhere('titulo', 'LIKE', $param1)
        ->where('ciudad', 'LIKE', $param2)
        ->orWhere('provincia', 'LIKE', $param2)
        ->get();

        return $tipoOferta;
    }

    //Ofertas por id de empresa incluyendo nombre y foto de empresa
    public function getOfertasPorE($idEmpresa){
        return Oferta::selectRaw('ofertas.* , empresas.name, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
        ->where('idempresa', '=',$idEmpresa)
        ->get();
    }

    //Número de usuarios suscritos a una oferta
    public function getOfertasPorENumU($idEmpresa){     

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

        //obtenemos las variables de filtro por url
        
        $id = $request->query('id');
        $activas = $request->query('activas');
        $orden = $request->query('orden');
        $estado = $request->query('estado');
        $keyword = $request->query('keyword');

        //aplicamos when en cada caso y traemos las ofertas junto con el nombre y la foto de la empresa

        return Oferta::selectRaw('ofertas.* , empresas.name, empresas.picture')
        ->join('empresas', 'ofertas.idempresa', '=', 'empresas.id')
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

    //Ofertas busqueda home y filtros
    public function getsearchHome(Request $request){

        //obtenemos las variables de filtro por url
        
        $puesto = $request->query('puesto');
        $lugar = $request->query('lugar');
        $salario = $request->query('salario');
        $experiencia = $request->query('experiencia');
        $jornada = $request->query('jornada');
        $keyWord = $request->query('keyWord');


        //obtenemos las ofteras junto con el nombre y la foto de empresa, utilizando when en cada filtro posible
        
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
        ->limit(50)
        ->get();
        
    }

    //Añadir una nueva nueva oferta
    public function newOferta(Request $request){

        //obtenemos las variables por body

        //inicializamos el estado y activo a 1 por defecto (el estado siempre empieza como "revisando")

        $idEmpresa = $request->input('idEmpresa');
        $titulo = $request->input('titulo');
        $ciudad = $request->input('ciudad');
        $salario = $request->input('salario');
        $sector = $request->input('sector');
        $vacantes = $request->input('vacantes');
        $experiencia = $request->input('experiencia');
        $jornada = $request->input('jornada');
        $descripcion = $request->input('description');
        $fecha = $request->input('fecha');
        $estado = 1;
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

    //Modificar el numero de vacantes y la descripcion de una oferta
    public function modOfertaE(Request $request){

        //recibimos las variables por body
        
        $idOferta = $request->input('id');
        $num_vacantes = $request->input('num_vacantes');
        $description = $request->input('description');

        return Oferta::where ('id', '=', $idOferta)
        ->update(['num_vacantes' => $num_vacantes, 'desc_general' => $description]);
    }
}
