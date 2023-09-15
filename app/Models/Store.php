<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $table = 'stores';
    protected $id = 'id';

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function food()
    {
        return $this->hasMany(Food::class);
    }
}
