<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    //
    public function getEmailU($email){
        return Usuario::where('email', 'LIKE', $email)->get();
    }

    public function getLoginU($param1, $param2){

        //encontramos al usuario en concreto
        $q = Usuario::where('email', 'LIKE', $param1)
         ->where('password', 'LIKE', $param2)->first()->id;

         //si existe, generamos el token
         if($q != null){
            $length = 50;
            $token = bin2hex(random_bytes($length));

            //guardamos el token en su campo correspondiente
            Usuario::where('id', '=', $q)
            ->update(['token' => $token]);

            //devolvemos al front la info necesaria ya actualizada
            return Usuario::where('email', 'LIKE', $param1)
            ->where('password', 'LIKE', $param2)->get();
         }
         return;
         
    }

    public function getLogOutU($id){
        //hacemos update en el campo token del usuario

        $token_empty = "";

        return Usuario::where('id', '=', $id)
        ->update(['token' => $token_empty]);
    }
    
}

