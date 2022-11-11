<?php

namespace App\Http\Middleware;

use App\Models\Commune;
use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class createCustomer
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

        /* "token":"36912939754ec1a501cb9405a8641b3954570297",
    "dni":"456734567",
    "id_reg": "1",
    "id_com":"2", 
    "email": "customer4@gmail.com", 
    "name":"customer4",  
    "last_name":"last4",   
    "address":"addres 4 #45",      
    "date_reg": "",  
    "status": ""   */  


        if(isset($request->dni) &&
            strlen($request->dni) == 9 &&
            isset($request->id_reg) &&
            isset($request->id_com) &&
            isset($request->email) &&
            isset($request->name) &&
            isset($request->last_name) &&
            isset($request->address)
        ){
            $com = Commune::where('id_com', $request->id_com)->first(); 
            if($com->id_reg == $request->id_reg){
                return $next($request);
            }else{
                dd('commune no coincide con region'); 
            }
        }else{
            dd('envia los datos correctamente'); 
        }
        $customer= Customer::join('communes','communes.id_com', 'customers.id_com')
        ->where(function ($query) use ($request) {
            $query->where('email', $request->searchBy)
                    ->orWhere('dni',  $request->searchBy);
        })
        ->whereIn('customers.status', ["A", "I"])
        ->first();
        // si no, lanzar error de inautorizado
        if(isset($customer)){
            $request->customer = $customer; 
        }
        else{
            return response()->json(
                data: [
                    'data'=> "Registro no existe",
                    'status' =>'false'
                ],
                status:401
            ); 
        }
        return $next($request);
    }
}
