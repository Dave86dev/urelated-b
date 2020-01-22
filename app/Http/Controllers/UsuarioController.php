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
}
