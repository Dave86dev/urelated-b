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

    // Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::get('/ofertas/{userId}', function ($userId)
    {
        return App\Usuario::find($userId)->load('suscripciones.oferta');
    });

    

    //Routes Usuarios
    Route::get('/loginU/{email}/{password}','UsuarioController@getLoginU');
    Route::get('/logOutU/{id}','UsuarioController@getLogOutU');
    
    //Routes Empresas
    Route::get('/loginE/{email}/{password}','EmpresaController@getLoginE');

    //Routes Suscripciones
    Route::get('/suscripciones','SuscripcionController@getAll');


    //Routes Ofertas
    Route::get('/allOfertas', 'OfertaController@getDefault');
    Route::get('/salarios/{salario}','OfertaController@getId');
    Route::get('/contratos/{tipo_contrato}','OfertaController@getContrato');
    Route::get('/ciudades/{ciudad}','OfertaController@getCiudad');
    Route::get('/puestos/{titulo}','OfertaController@getPuesto');
    Route::get('/sectores/{sector}','OfertaController@getSector');
    
    Route::get('/zonas/{param1}','OfertaController@getCiudadProvincia');
    Route::get('/search/{param1}','OfertaController@getSearch1');
    
    Route::get('/ofertasEmpresa/{param1}','OfertaController@getOfertaEmpresaName');
    
    Route::get('/ofertasOk/{param1}','OfertaController@getOfertas1');
});


