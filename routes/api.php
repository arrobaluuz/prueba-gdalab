<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getToken',[SessionController::class, 'getToken'])->name('getToken');


Route::group(['prefix' =>'customer', 'middleware'=>['authToken']],function(){
    // 1. Se registren Customers.
    Route::post('create',[CustomerController::class, 'create'])->middleware('createCustomer');
    //2. Se consulten Customer por dni o email.
    Route::get('/',[CustomerController::class, 'get']);
    //3. Eliminar lógicamente el customer del sistema.
    Route::delete('delete', [CustomerController::class, 'delete'])->middleware('deleteCustomer');
});

