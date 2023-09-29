<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    public function nutritionalValues()
    {
        return $this->hasMany(NutritionalValue::class);
    }
    public function category()
    {
        return $this->hasOneThrough(Category::class, CategoryAndFood::class, 'food_id', 'id', 'id', 'category_id');
    }
    // public function categoryAndFood()
    // {
    //     return $this->hasOne(CategoryAndFood::class);
    // }

}
