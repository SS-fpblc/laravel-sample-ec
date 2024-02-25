<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'price',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function watch()
    {
        return $this->hasMany(Watch::class);
    }
    
    public function watchingUser()
    {
        return $this->belongsToMany(User::class, 'watches')->withPivot('updated_at');
    }
    
    public function isWatchedBy($user_id)
    {
        $watching_users_ids = $this->watchingUser->pluck('id');
        $result = $watching_users_ids->contains($user_id);
        
        return $result;
    }
}
