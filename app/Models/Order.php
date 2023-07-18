<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];
    
    public $timestamps = true;
}