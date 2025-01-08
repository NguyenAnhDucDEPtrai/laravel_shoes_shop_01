<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'shoe_id',
        'size_id',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shoe()
    {
        return $this->belongsTo(Shoe::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
