<?php

namespace App\Http\Middleware;
use Illuminate\Database\QueryException;
use App\Usuario;
use App\Empresa;
use Closure;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //recogemos el usertype (candidato o empresa) por body además del token


        $userType = $request->input('userType');
        $token = $request->input('token');


        //si es candidato...
        if($userType == "Candidato"){

           try {

                $q = Usuario::where('token', 'LIKE', $token)->first();
            
                if(!$q){
                    //token no coincide.. return
                    return; 
                }
             
                return $next($request);

           } catch(QueryException $err) {
                return $err;
           }
            
        }

        //si es empresa...
        if($userType == "Empresa"){

            try {

                $q = Empresa::where('token', 'LIKE', $token);

                if(!$q){
                  //token no coincide.. return
                  return; 
                }
               
                return $next($request);
 
            } catch(QueryException $err) {
                 return $err;
            }

        }

        
    }
}
