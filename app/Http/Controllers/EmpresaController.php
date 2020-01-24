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

    public function getLoginE($param1, $param2){
        return Empresa::where('email', 'LIKE', $param1)
        ->where('password', 'LIKE', $param2)->get();
    }
}
