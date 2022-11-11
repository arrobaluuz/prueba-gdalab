<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CommuneStatus;

class Commune extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'communes';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_com';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = ['id_reg', 'status'];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'status' => CommuneStatus::class
    ];
}




