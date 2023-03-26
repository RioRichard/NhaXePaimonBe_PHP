<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Route extends Authenticatable
{

    use HasFactory, HasApiTokens;
    protected $table = "routes";
    protected $fillable = ['id', 'fromId', 'toId','departure','arrival','bus','driver','extraStaff','price','status'];
    public $timestamps = false;   

}

