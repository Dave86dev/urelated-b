<?php

use Illuminate\Http\Request;
use App\usuario;
use App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['cors']], function () {
    //Rutas a las que se permitirá acceso

    //Routes Usuarios
    Route::get('/perfilU/{id}', 'UsuarioController@getPerfilU');
    
    Route::post('/registerU', 'UsuarioController@postRegisterU');
    Route::post('/loginU','UsuarioController@postLoginU');
    Route::post('/logOutU','UsuarioController@postLogOutU');
    Route::post('/perfilUMod', 'UsuarioController@postPerfilUMod');

    
    //Routes Empresas
    Route::get('/perfilE/{id}', 'EmpresaController@getPerfilE');
    
    Route::post('/registerE', 'EmpresaController@postRegisterE');
    Route::post('/loginE', 'EmpresaController@postLoginE');
    Route::post('/logOutE','EmpresaController@postLogOutE');
    Route::post('/perfilEMod', 'EmpresaController@postPerfilEMod');


    //Routes Suscripciones
    Route::get('/suscripciones','SuscripcionController@getAll');


    //Routes Ofertas
    Route::get('/allOfertas', 'OfertaController@getDefault');
    Route::get('/salarios/{salario}','OfertaController@getSalario');
    Route::get('/contratos/{tipo_contrato}','OfertaController@getContrato');
    Route::get('/ciudades/{ciudad}','OfertaController@getCiudad');
    Route::get('/puestos/{titulo}','OfertaController@getPuesto');
    Route::get('/sectores/{sector}','OfertaController@getSector');
    Route::get('/zonas/{param1}','OfertaController@getCiudadProvincia');
    Route::get('/search/{param1}','OfertaController@getSearch1');
    Route::get('/searchHome', 'OfertaController@getsearchHome');
    Route::get('/ofertasEmpresa/{param1}','OfertaController@getOfertaEmpresaName');
    Route::get('/tipoOferta/{param1}','OfertaController@getOfertas1');
    Route::get('/busquedaFiltro/{param1}/{param2}', 'OfertaController@getOfertasBoth');
    Route::get('/ofertasPorE/{idEmpresa}', 'OfertaController@getOfertasPorE');
    Route::get('/ofertasPorEmp', 'OfertaController@getOfertasPorEmp');
    Route::get('/busquedaSuscritos/{idEmpresa}', 'OfertaController@getOfertasPorENumU');
    Route::get('/ofertas/{userId}', function ($userId)
    {
        return App\Usuario::find($userId)->load('suscripciones.oferta');
    });
});


