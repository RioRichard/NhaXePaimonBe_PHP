<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Base extends Authenticatable
{

    use HasFactory, HasApiTokens;
    protected $table = "bases";
    protected $fillable = ['id', 'name', 'address'];
    public $timestamps = false;   

}

