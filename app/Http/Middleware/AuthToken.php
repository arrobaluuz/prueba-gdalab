<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
        $authenticate = User::where([
                        ['token', $request->token], 
                        ['dateFinishToken', '>=', Carbon::now()]
            ])
            ->first();
        
        // si no, lanzar error de inautorizado
        if(empty($authenticate)){   
            return response()->json(
                data: [
                    'data'=> "you don't have permission to access this resource",
                    'status' =>'false'
                ],
                status:401
            ); 
        }else{
            return $next($request);
        }
    }
}
