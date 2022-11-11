<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class deleteCustomer
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
            return $next($request);
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
    }
}
