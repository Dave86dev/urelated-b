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

        $userType = $request->input('userType');
        $token = $request->input('token');

        if($userType == "Candidato"){

           try {

                $q = Usuario::where('token', 'LIKE', $token)->first();
            
                if(!$q){
                    return; 
                }
             
                return $next($request);

           } catch(QueryException $err) {
                return $err;
           }
            
        }

        if($userType == "Empresa"){

            try {

                $q = Empresa::where('token', 'LIKE', $token);

                if(!$q){
                  return; 
                }
               
                return $next($request);
 
            } catch(QueryException $err) {
                 return $err;
            }

        }

        
    }
}
