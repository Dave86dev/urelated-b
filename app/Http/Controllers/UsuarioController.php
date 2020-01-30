<?php


namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    //Obtener perfil usuario por id
    public function getPerfilU ($id){

        try {

            return Usuario::all()->where('id', '=', $id)
            ->makeHidden(['password']);
       
        } catch (QueryException $error){
            return $error;
        }
    }

    //Obtener usuario por email
    public function getEmailU($email){

        try {

            return Usuario::where('email', 'LIKE', $email)->get();

        } catch (QueryException $error){

            return $error;
        
        }

    }

    //Login usuario
    public function postLoginU(Request $request){
        
        $email = $request->input('email');
        $password = $request->input('password'); 
        


        try {

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

        } catch(QueryException $error){
            return $error;
        }
    }

    //Logout de usuario
    public function postLogOutU(Request $request){
        //hacemos update en el campo token del usuario

        $id = $request->input('id');

        $token_empty = "";

        try {

            return Usuario::where('id', '=', $id)
            ->update(['token' => $token_empty]);

        } catch(QueryException $error){
            return $error;
        }
    }

    //Registro usuario
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


        } catch(QueryException $error) {
             return $error;
        }
    }

    //Modificar perfil usuario
    public function postPerfilUMod(Request $request){

        //Actualiza el pefil de candidato

        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $ciudad = $request->input('ciudad');
        $provincia = $request->input('provincia');
        $pais = $request->input('country');

        try {


        } catch (QueryException $error) {
            return $error;
        }

        return Usuario::where('id', '=', $id)
        ->update(['phone' => $phone, 'email' => $email,
        'ciudad' => $ciudad, 'provincia' => $provincia, 
        'pais' => $pais, 'name' => $name, 'surname' => $surname]);
    }
   
}
