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
        return Usuario::where('email', 'LIKE', $param1)
        ->where('password', 'LIKE', $param2)->get();
    }
    

}

