<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'option_product')
            ->withPivot('price')
            ->withTimestamps();
    }
}
