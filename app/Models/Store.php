<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'owner_name',
        'address',
        'phone_number',
        'email',
        'explanation',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
