<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
