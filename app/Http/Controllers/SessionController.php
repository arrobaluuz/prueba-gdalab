<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Region;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function getToken(Request $email){
        try {
            //construcción del token 
            $email= $email->input();
            $random = rand(200,500);
            $hora = Carbon::now();
            $token= sha1($email['email'].$hora.$random);
            //asignación del token al usuario
            User::where('email', $email['email'])->first()
            ->update([
                "token" => $token, 
                "dateFinishToken" => Carbon::parse($hora)->addHour()
            ]);
            //respuesta exitosa
            return response()->json(
                data: [
                    'data'=> $token,
                    'status' =>'true' 
                ],
                status:200
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
