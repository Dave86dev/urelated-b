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
    public function getCurriculum (Request $request){

        $idusuario = $request->query('idusuario');

        try {

            return Curriculum::where('idusuario', '=', $idusuario)
            ->get();
       
        } catch (QueryException $error){
            return $error;
        }
    }

    //Registro curriculum
    public function newCurriculum(Request $request){
        
        $idusuario = $request->input('idusuario');
        $isWorking = $request->input('isWorking');
        $isWorked_before = $request->input('isWorked_before');
        $isEstudios = $request->input('isEstudios');
        $formacion = $request->input('formacion');
        $experiencia = $request->input('experiencia');

        try {

            return Curriculum::create(
                [
                    'idusuario' => $idusuario,
                    'isWorking' => $isWorking,
                    'isWorked_before' => $isWorked_before,
                    'isEstudios' => $isEstudios,
                    'formacion' => $formacion,
                    'experiencia'=> $experiencia,
                ]);


        } catch(QueryException $error) {
             return $error;
        }
    } 
    //modificar curriculum
    public function modCurriculum(Request $request){
        
        $id = $request->input('id');
        $isWorking = $request->input('isWorking');
        $isWorked_before = $request->input('isWorked_before');
        $isEstudios = $request->input('isEstudios');
        $formacion = $request->input('formacion');
        $experiencia = $request->input('experiencia');

        try {

            return Curriculum::where('id', '=', $id)
            ->update(['isWorking' => $isWorking, 'isWorked_before' => $isWorked_before,
            'isEstudios' => $isEstudios, 'formacion' => $formacion, 
            'experiencia' => $experiencia]);


        } catch(QueryException $error) {
             return $error;
        }
    } 
}
