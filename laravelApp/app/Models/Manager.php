<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class Manager extends Authenticatable implements JWTSubject
{

    use HasFactory, HasApiTokens,Notifiable;
    protected $table = "manager";
    protected $fillable = ['id', 'userName', 'password', 'name', 'email', 'phone', 'role'];
    public $timestamps = false;   

    protected $hidden = [
        'password'
        
    ];
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}

