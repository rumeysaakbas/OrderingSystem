<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [ 'category_name', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function categoryAndFood()
    {
        return $this->belongsTo(CategoryAndFood::class);
    }
}
