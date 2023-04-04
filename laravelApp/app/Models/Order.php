<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Order extends Model
{
    use HasFactory;
    protected $table = "order";
    protected $fillable = ['id', 'userId', 'routeId', 'seatId', 'status', 'paymentInfo','promoteId'];
    public $timestamps = false;  
}
