<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'userId', 'routeId', 'seatsId', 'status', 'paymentInfo','promoteId'];
    public $timestamps = false;  
}
