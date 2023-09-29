<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class NutritionalValue extends Model
{
    use HasFactory;
    
    protected $fillable = ['food_id', 'type', 'value'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
