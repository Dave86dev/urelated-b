<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;


class SuscripcionController extends Controller
{
    //
    public function getAll(){
        return Suscripcion::all();
    }
}
