<?php


namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Usuario;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    //Obtener perfil usuario por id
    public function getPerfilU ($id){

        try {

            return Usuario::all()->where('id', '=', $id)
            ->makeHidden(['password'])->keyBy('id');
       
        } catch (QueryException $error){
            return $error;
        }
    }

    //Obtener usuario por email
    public function recoverPass(Request $request){

        $email = $request->input('email');
        $userType = $request->input('userType');
        

        try {

            if($userType == "Candidato"){
                return Usuario::where('email', 'LIKE', $email)->pluck('secretQ')->toArray();
            }else { 
                return Empresa::where('email', 'LIKE', $email)->pluck('secretQ')->toArray();
            }

        } catch (QueryException $error){

            return $error;
        
        }

    }

    //Obtener usuario por email
    public function recoverPass2(Request $request){

        $email = $request->input('email');
        $secretA = $request->input('secretA');
        $password = $request->input('password');
        $userType = $request->input('userType');

        $password = Hash::make($password);

        try {

            if ($userType == "Candidato"){
                return Usuario::where('email', '=', $email)
                ->where('secretA', '=', $secretA)
                ->update(['password' => $password]);
            } else {
                return Empresa::where('email', '=', $email)
                ->where('secretA', '=', $secretA)
                ->update(['password' => $password]);
            }
        
        } catch (QueryException $error) {
            return $error;
        }

    }

    //Login usuario
    public function postLoginU(Request $request){
        
        $email = $request->input('email');
        $password = $request->input('password'); 
        
        try {

            //primero cotejamos el pass encriptado

            $validate_user = Usuario::select('password')
            ->where('email', 'LIKE', $email)
            ->first();

            if(!$validate_user){
                return response()->json([
                    //email incorrecto
                    'error' => "Error_1"
                ]); 
            }
            
            $hashed = $validate_user->password;
            
            if(Hash::check($password, $hashed)){
                
                //si existe, generamos el token
                
                $length = 50;
                $token = bin2hex(random_bytes($length));

                //guardamos el token en su campo correspondiente
                Usuario::where('email',$email)
                ->update(['token' => $token]);

                //devolvemos al front la info necesaria ya actualizada
                return Usuario::where('email', 'LIKE', $email)
                ->get();
            
            }else{
                return response()->json([
                    //password incorrecto
                    'error' => "Error_2"
                ]);
            }
         
        } catch(QueryException $error){
            
            return response()->$error;
                
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

    //Registro usuario (candidato)
    public function postRegisterU(Request $request){
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $picture = $request->input('picture');
        $password = $request->input('password');
        $secretQ = $request->input('secretQ');
        $secretA = $request->input('secretA');
        $phone = $request->input('phone');
        $ciudad = $request->input('ciudad');
        $provincia = $request->input('provincia');
        $pais = $request->input('pais');

        $password = Hash::make($password);

        try {

            return Usuario::create(
                [
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'picture' => $picture,
                    'password' => $password,
                    'secretQ' => $secretQ,
                    'secretA' => $secretA,
                    'phone' => $phone,
                    'ciudad' => $ciudad,
                    'provincia' => $provincia,
                    'pais' => $pais
                ]);


        } catch(QueryException $error) {
            
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }
        }
    }

    //Modifica perfil usuario (candidato) 
    public function postPerfilUMod(Request $request){

        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $ciudad = $request->input('ciudad');
        $provincia = $request->input('provincia');
        $pais = $request->input('country');

        try {
            return Usuario::where('id', '=', $id)
                    ->update(['phone' => $phone, 'email' => $email,
                    'ciudad' => $ciudad, 'provincia' => $provincia, 
                    'pais' => $pais, 'name' => $name, 'surname' => $surname]);

        } catch (QueryException $error) {
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }
        }

        
    }
   
}
