<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAndFood extends Model
{
    use HasFactory;
    protected $fillable = [ 'category_id', 'food_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function food()
    {
        return $this->belongsToMany(Food::class);
    }
}
