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
}
