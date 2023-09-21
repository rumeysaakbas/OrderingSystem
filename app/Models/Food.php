<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'stock',
        'explanation',
        'price',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }
}
