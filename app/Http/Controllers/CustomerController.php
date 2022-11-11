<?php

namespace App\Http\Controllers;

use App\Enums\CommuneStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Region;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function create( Request $request){
        try {
            Customer::create([
                "dni"=>$request->dni,
                "id_reg"=> $request->id_reg,
                "id_com"=>$request->id_com, 
                "email"=> $request->email, 
                "name"=>$request->name,  
                "last_name"=>$request->last_name,   
                "address"=>$request->address,      
                "date_reg"=> Carbon::now(),  
                "status"=> CommuneStatus::Activo
            ]);
            //respuesta exitosa
            return response()->json(
                data: [
                    'data'=> 'Creado exitosamente',
                    'status' =>'true' 
                ],
                status:202
            );
        } catch (\Throwable $th) {
            return response()->json(
                data: [
                    'data'=> $th,
                    'status' =>'false' 
                ],
                status:403
            );
        }
    }
    /*  La consulta debe hacerse solo con customer activos (A), no con desactivo (I) o
            eliminados (trash), adicionalmente deberá retornar name, last_name, address (de
            no tener address retorna null en el campo), description region y commune. Realizar
            validaciones pertinentes. */
    public function get(Request $request){
        try {
            //consultar el customer por su email o por su dni 
            $customer = Customer::join('communes','communes.id_com', 'customers.id_com')
            ->join('regions', 'regions.id_reg', 'customers.id_reg')
            ->select('customers.name', 'customers.last_name',
            DB::raw('CASE WHEN customers.address != "" THEN customers.address ELSE "NULL" END as address2'),  
            'communes.description as commune', 'regions.description as region')
            ->where('customers.status', 'A')
            ->where(function ($query) use ($request) {
                $query->where('email', $request->searchBy)
                      ->orWhere('dni',  $request->searchBy);
            })
            ->first();

            if(isset($customer)){
                //respuesta exitosa
                return response()->json(
                    data: [
                        'data'=> $customer,
                        'status' =>'true' 
                    ],
                    status:202
                );
            }else{
                return response()->json(
                    data: [
                        'data'=> 'Customer no encontrado',
                        'status' =>'false' 
                    ],
                    status:403
                );
            }   
        } catch (\Throwable $th) {
            return response()->json(
                data: [
                    'data'=> $th,
                    'status' =>'false' 
                ],
                status:403
            );
        }
    }
    
    /* 3. El customer a eliminar debe de estar activo (A) o desactivo (I). En el caso de estar
        ya eliminado (trash) retornar “Registro no existe”. */
    public function delete( Request $request){
        try {
            //recuperar el customer del middleware
            $customer = $request->customer; 
            $customer->update([ 'status' => CommuneStatus::Eliminado]);
            //respuesta exitosa
            return response()->json(
                data: [
                    'data'=> 'Eliminado exitosamente',
                    'status' =>'true' 
                ],
                status:202
            );
        } catch (\Throwable $th) {
            return response()->json(
                data: [
                    'data'=> $th,
                    'status' =>'false' 
                ],
                status:403
            );
        }
    }
    

}
