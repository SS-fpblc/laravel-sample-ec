<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'amount',
    ];
    
    public function orderedBy()
    {
        return $this->belongsTo(User::class);
    }
    
    // public function scopeOrderByUserId($query, $user_id)
    // {
    //     return $query->where('user_id', '=', $user_id)->latest()->get();
    // }
    
    public function detail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
