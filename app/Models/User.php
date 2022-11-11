<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_user
 * @property string $email
 * @property string $token
 * @property string $dateFinishToken
 */
class User extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * @var array
     */
    protected $fillable = ['email', 'token', 'dateFinishToken'];

    public $timestamps= false;
}
