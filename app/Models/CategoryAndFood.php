<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAndFood extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class);
    }
    
    public function food()
    {
        return $this->hasOne(Food::class);
    }
}
