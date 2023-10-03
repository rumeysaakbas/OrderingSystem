<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRawMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['food_id', 'name', 'value', 'value_types_id'];

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function valueType()
    {
        return $this->belongsTo(ValueTypes::class, 'value_types_id');
    }
}
