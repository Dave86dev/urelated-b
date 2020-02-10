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

//Rutas a las que se permitirá acceso
Route::group(['middleware' => ['cors']], function () {
    

    //Rutas Usuarios

    //obtener datos de perfil de candidato con su id
    Route::get('/perfilU/{id}', 'UsuarioController@getPerfilU');

    //fase 1 de la recuperacion de password
    Route::post('/recoverP', 'UsuarioController@recoverPass')->middleware('token');

    //fase 2 de la recuperación de password
    Route::post('/recoverP2', 'UsuarioController@recoverPass2')->middleware('token');

    //registro de candidato
    Route::post('/registerU', 'UsuarioController@postRegisterU');

    //login de candidato
    Route::post('/loginU','UsuarioController@postLoginU');

    //logout de candidato
    Route::post('/logOutU','UsuarioController@postLogOutU');

    //modificar el perfil de candidato
    Route::post('/perfilUMod', 'UsuarioController@postPerfilUMod')->middleware('token');

    
    //Rutas Empresas

    //obtener datos de perfil de empresa con su id
    Route::get('/perfilE/{id}', 'EmpresaController@getPerfilE');

    //registrar una nueva empresa
    Route::post('/registerE', 'EmpresaController@postRegisterE');

    //login de empresa
    Route::post('/loginE', 'EmpresaController@postLoginE');

    //logout de empresa
    Route::post('/logOutE','EmpresaController@postLogOutE');

    //modificar el perfil de empresa
    Route::post('/perfilEMod', 'EmpresaController@postPerfilEMod')->middleware('token');


    //Rutas Suscripciones

    //obtener suscripciones
    Route::get('/suscripciones','SuscripcionController@getAll');

    //obtener el número de suscritos
    Route::get('/numSuscritos','SuscripcionController@cuentaSuscritos');

    //certificar la existencia de un candidato en la base de datos
    Route::get('/isCandidato','SuscripcionController@existeCandidato');

    //obtener suscripciones por candidato
    Route::get('/suscripcionesPorU', 'SuscripcionController@suscripcionesPorU');

    //obtener suscripciones por empresa
    Route::get('/suscripcionesPorE', 'SuscripcionController@suscripcionesPorE');

    //añadir una nueva suscripción
    Route::post('/nuevaSuscripcion', 'SuscripcionController@nuevaSuscripcion');

    //modificar suscripción
    Route::post('/modSuscripcion', 'SuscripcionController@modSuscripcion');

    //borrar suscripción
    Route::post('/delSuscripcion', 'SuscripcionController@delSuscripcion');
    

    //Rutas Ofertas

    //obtener todas las ofertas
    Route::get('/allOfertas', 'OfertaController@getDefault');

    //obtener una oferta por 1 id concreto
    Route::get('/ofertaId/{id}', 'OfertaController@getOfertaId');

    //búsqueda de salario filtro home
    Route::get('/salarios/{salario}','OfertaController@getSalario');

    //busqueda de contrato filtro home
    Route::get('/contratos/{tipo_contrato}','OfertaController@getContrato');

    //busqueda de ciudades filtro home
    Route::get('/ciudades/{ciudad}','OfertaController@getCiudad');

    //búsqueda de puesto filtro home
    Route::get('/puestos/{titulo}','OfertaController@getPuesto');

    //búsqueda de sector filtro home
    Route::get('/sectores/{sector}','OfertaController@getSector');

    //búsqueda de provincia filtro home
    Route::get('/zonas/{param1}','OfertaController@getCiudadProvincia');

    //búsqueda con el primer parámetro de la search bar
    Route::get('/search/{param1}','OfertaController@getSearch1');

    //búsqueda con la searchbar
    Route::get('/searchHome', 'OfertaController@getsearchHome');

    //búsqueda de ofertas publicadas por una empresa en concreto
    Route::get('/ofertasEmpresa/{param1}','OfertaController@getOfertaEmpresaName');

    //búsqueda según el tipo de oferta
    Route::get('/tipoOferta/{param1}','OfertaController@getOfertas1');

    //búsqueda de ofertas por ambos parámetros
    Route::get('/busquedaFiltro/{param1}/{param2}', 'OfertaController@getOfertasBoth');

    //búsqueda de ofertas dado un id de empresa concreto
    Route::get('/ofertasPorE/{idEmpresa}', 'OfertaController@getOfertasPorE');

    //todas las ofertas por empresa
    Route::get('/ofertasPorEmp', 'OfertaController@getOfertasPorEmp');

    //búsqueda de suscritos a una oferta concreta
    Route::get('/busquedaSuscritos/{idEmpresa}', 'OfertaController@getOfertasPorENumU');

    //ofertas según id de usuario
    Route::get('/ofertas/{userId}', function ($userId)
    {
        return App\Usuario::find($userId)->load('suscripciones.oferta');
    });

    //registrar una nueva oferta
    Route::post('/nuevaOferta', 'OfertaController@newOferta')->middleware('token');

    //modificar una oferta existente
    Route::post('/modOfertaE', 'OfertaController@modOfertaE')->middleware('token');

    //Rutas Curriculum

    //obtener un currículum de usuario
    Route::get('/curriculum', 'CurriculumController@getCurriculum');

    //registrar un nuevo currículum
    Route::post('/nuevoCurriculum', 'CurriculumController@newCurriculum')->middleware('token');

    //modificar un currículum existente
    Route::post('/modCurriculum', 'CurriculumController@modCurriculum')->middleware('token');
});


