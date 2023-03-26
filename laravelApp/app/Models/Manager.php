<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Manager extends Authenticatable
{

    use HasFactory, HasApiTokens;
    protected $table = "manager";
    protected $fillable = ['id', 'userName', 'password', 'name', 'email', 'phone', 'role'];
    public $timestamps = false;   

}

