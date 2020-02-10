<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Empresa;
use Illuminate\Support\Facades\Hash;

class EmpresaController extends Controller
{
    //Obtener empresa por e-mail de empresa
    public function getEmailE($email){
        return Empresa::where('email', 'LIKE', $email)->get();
    }

    //Login empresa
    public function postLoginE(Request $request){
        
        $email = $request->input('email');
        $password = $request->input('password'); 
        
        try {

            //primero cotejamos que existe el email en la tabla empresas

            $validate_user = Empresa::select('password')
            ->where('email', 'LIKE', $email)
            ->first();

            if(!$validate_user){
                return response()->json([
                    //email incorrecto, devolvemos error correspondiente
                    'error' => "E-mail o password incorrecto"
                ]); 
            }
            
            $hashed = $validate_user->password;

            //cotejamos que el password sea el correspondiente al email
            
            if(Hash::check($password, $hashed)){
                
                //si existe, generamos el token
                
                $length = 50;
                $token = bin2hex(random_bytes($length));

                //guardamos el token en su campo correspondiente
                Empresa::where('email',$email)
                ->update(['token' => $token]);

                //devolvemos al front la info necesaria ya actualizada
                return Empresa::where('email', 'LIKE', $email)
                ->get();
            }else{
                return response()->json([
                    //password incorrecto, devolvemos error correspondiente
                    'error' => "E-mail o password incorrecto"
                ]);
            }
         
        } catch(QueryException $error){
            return $error;
        }

    }

    //Logout empresa
    public function postLogOutE(Request $request){

        $id = $request->input('id');

        $token_empty = "";

        return Empresa::where('id', '=', $id)
        ->update(['token' => $token_empty]);
    }

    //Perfil empresa por id
    public function getPerfilE($id){
        return Empresa::all()->where('id', '=', $id)
        ->makeHidden(['password'])->keyBy('id');
    }

    //Registrar una empresa
    public function postRegisterE(Request $request){

        //obtención de los datos por body

        $username = $request->input('username');
        $surname = $request->input('surname');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $secretQ = $request->input('secretQ');
        $secretA = $request->input('secretA');
        $phone = $request->input('phone');
        $sector = $request->input('sector');
        $description = $request->input('description');
        $picture = $request->input('picture');

        //encriptación de password
        $password = Hash::make($password);

        try {

            return Empresa::create(
                [
                    'name_reg' => $username,
                    'surname_reg' => $surname,
                    'name' => $name,
                    'email' => $email,
                    'picture' => $picture,
                    'password' => $password,
                    'secretQ' => $secretQ,
                    'secretA' => $secretA,
                    'phone' => $phone,
                    'sector' => $sector,
                    'description' => $description
                ]);


        } catch(QueryException $error) {
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    //devolvemos este error en caso de que hayan tratado de duplicar el email
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }
        }
    }

    //Modifica el perfil de una empresa
    public function postPerfilEMod(Request $request){


        //obtención de datos por body

        $id = $request->input('id');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $name = $request->input('name');
        $description = $request->input('description');
        $sector = $request->input('sector');


        try {

        return Empresa::where ('id', '=', $id)
        ->update(['email' => $email, 'phone' => $phone, 'name' => $name,
        'description' => $description, 'sector' => $sector]);

        } catch (Queryexception $error) {
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    //evitamos que registren un e-mail ya existente en una modificación de perfil
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }
        }

        
    }

}