<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'image'
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
