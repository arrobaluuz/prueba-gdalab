<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RegionStatus;

class Region extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'regions';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_reg';

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
    protected $fillable = ['description', 'status'];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'status' => RegionStatus::class
    ];
}



