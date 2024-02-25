<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    // public function scopeOrderDetailByOrderId($query, $order_id)
    // {
    //     return $query->where('order_id', '=', $order_id)->latest()->get();
    // }
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
