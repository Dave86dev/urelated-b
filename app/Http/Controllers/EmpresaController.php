<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresaController extends Controller
{
    //
    public function getEmailE($email){
        return Empresa::where('email', 'LIKE', $email)->get();
    }

    public function postLoginE(Request $request){
        
        $email = $request->input('email');
        $password = $request->input('password'); 
        
        $q = Empresa::where('email', 'LIKE', $email)
         ->where('password', 'LIKE', $password)->first()->id;

         //si existe, generamos el token
         if($q != null){
            $length = 50;
            $token = bin2hex(random_bytes($length));

            //guardamos el token en su campo correspondiente
            Empresa::where('id', '=', $q)
            ->update(['token' => $token]);

            //devolvemos al front la info necesaria ya actualizada
            return Empresa::where('email', 'LIKE', $email)
            ->where('password', 'LIKE', $password)->get();
         }
         return;

    }

    public function postLogOutE(Request $request){
        //hacemos update en el campo token de la empresa

        $id = $request->input('id');

        $token_empty = "";

        return Empresa::where('id', '=', $id)
        ->update(['token' => $token_empty]);
    }

    //Actualiza el pefil de empresa
    public function perfilEMod($id, $paramEmail, $paramPhone, $paramName,
    $paramDescription, $paramSector){
        return Empresa::where ('id', '=', $id)
        -update(['email' => $paramEmail, 'phone' => $paramEmail, 'name' => $paramPhone,
        'description' => $paramDescription, 'sector' => $paramSector]);
    }

    public function getPerfilE($id){
        return Empresa::all()->where('id', '=', $id)
        ->makeHidden(['password']);
    }

    public function postRegisterE(Request $request){
        //Registro empresa
        $username = $request->input('userame');
        $surname = $request->input('surname');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $secretQ = $request->input('secretQ');
        $secretA = $request->input('secretA');
        $phone = $request->input('phone');
        $sector = $request->input('sector');
        $description = $request->input('description');

        $q = Empresa::where('email', 'LIKE', $email)->first()->id;

        //if($q !=null){

        //}
    }

}









// public function getLoginE($param1, $param2){
        
    //     //encontramos a la empresa en concreto
    //     $q = Empresa::where('email', 'LIKE', $param1)
    //     ->where('password', 'LIKE', $param2)->first()->id;

    //     //si existe, generamos el token
    //     if($q != null){
    //         $length = 50;
    //         $token = bin2hex(random_bytes($length));

    //         //guardamos el token en su campo correspondiente
    //         Empresa::where('id', '=', $q)
    //         ->update(['token' => $token]);

    //         //devolvemos al front la info necesaria ya actualizada
    //         return Empresa::where('email', 'LIKE', $param1)
    //         ->where('password', 'LIKE', $param2)->get();
    //     }
    //     return;
    // }