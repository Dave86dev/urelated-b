<?php


namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Curriculum;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class CurriculumController extends Controller
{

    //Obtener curriculum por id Usuario
    public function getCurriculum ($idusuario){

        try {

            return Curriculum::where('idusuario', '=', $idusuario);
       
        } catch (QueryException $error){
            return $error;
        }
    }

    //Registro curriculum
    public function newCurriculum(Request $request){
        //Registro candidato
        $idusuario = $request->input('id');
        $isWorked = $request->input('isWorked');
        $isWorked_before = $request->input('isWorked_before');
        $isEstudios = $request->input('isEstudios');
        $formacion = $request->input('formacion');
        $experiencia = $request->input('experiencia');

        try {

            return Curriculum::create(
                [
                    'idusuario' => $idusuario,
                    'isWorked' => $isWorked,
                    'isWorked_before' => $isWorked_before,
                    'isEstudios' => $isEstudios,
                    'formacion' => $formacion,
                    'experiencia'=> $experiencia,
                ]);


        } catch(QueryException $error) {
             return $error;
        }
    } 
}
