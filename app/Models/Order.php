<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'orders_id', 'id')->with('menuVariant');
    }

    public function orderPayment() {
        return $this->hasOne(OrderPayment::class, 'orders_id', 'id');
    }
}
