<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CustomerStatus;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    public $timestamps = false; 
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = ["dni", "id_reg",
    "id_com", 
    "email",
    "name", 
    "last_name",  
    "address",     
    "date_reg",  
    "status"];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'status' => CustomerStatus::class
    ];
}




