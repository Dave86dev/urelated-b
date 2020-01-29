<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Usuario;

class UsuarioController extends Controller
{
    //Obtener usuario por email
    public function getEmailU($email){
        return Usuario::where('email', 'LIKE', $email)->get();
    }

    
    /*protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            ]);
        }*/
        
    
    public function postLoginU(Request $request){
        
        $email = $request->input('email');
        $password = $request->input('password'); 
        
        $q = Usuario::where('email', 'LIKE', $email)
         ->where('password', 'LIKE', $password)->first()->id;

         //si existe, generamos el token
         if($q != null){
            $length = 50;
            $token = bin2hex(random_bytes($length));

            //guardamos el token en su campo correspondiente
            Usuario::where('id', '=', $q)
            ->update(['token' => $token]);

            //devolvemos al front la info necesaria ya actualizada
            return Usuario::where('email', 'LIKE', $email)
            ->where('password', 'LIKE', $password)->get();
         }
         return;

    }

    

    //Logout de usuario borrando el campo token
    public function postLogOutU(Request $request){
        //hacemos update en el campo token del usuario

        $id = $request->input('id');

        $token_empty = "";

        return Usuario::where('id', '=', $id)
        ->update(['token' => $token_empty]);
    }

    //Actualizar perfil de usuario
    public function perfilUMod(Request $request){

        //$id, $paramPhone, $paramEmail, $paramCiudad,
        //$paramProvincia, $paramPais, $paramName, $paramSurname

        // return Usuario::where('id', '=', $id)
        // ->update(['phone' => $paramPhone, 'email' => $paramEmail,
        // 'ciudad' => $paramCiudad, 'provincia' => $paramProvincia, 
        // 'pais' => $paramPais, 'name' => $paramName, 'surname' => $paramSurname]);
        
    }

    public function getPerfilU ($id){
        return Usuario::all()->where('id', '=', $id)
        ->makeHidden(['password']);
       
        //muestra 1 en el resultado en la web

    }

    public function postRegisterU(Request $request){
        //Registro candidato
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $password = $request->input('password');
        $secretQ = $request->input('secretQ');
        $secretA = $request->input('secretA');
        $phone = $request->input('phone');
        $ciudad = $request->input('ciudad');
        $provincia = $request->input('provincia');
        $pais = $request->input('pais');

        try {

            return Usuario::create(
                [
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'password' => $password,
                    'secretQ' => $secretQ,
                    'secretA' => $secretA,
                    'phone' => $phone,
                    'ciudad' => $ciudad,
                    'provincia' => $provincia,
                    'pais' => $pais
                ]);


        } catch(QueryException $err) {
             echo ($err);
        }
    }


    
}



/*//Login de usuario con las credenciales de email y password
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
         
    }*/

