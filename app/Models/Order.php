<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];
    
    public function customer()
    {
        return $this->belongsTo(User::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
