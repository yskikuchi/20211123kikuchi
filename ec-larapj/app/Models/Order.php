<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdersDetail;

class Order extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable=[
        'user_id',
        'id'
    ];

    public function orderDetails(){
        return $this->belongsToMany(OrdersDetail::class);
    }
}
