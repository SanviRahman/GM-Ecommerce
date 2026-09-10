<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //
    protected $fillable = [
        'name',
        'banner_title',
        'video',
        'banner',
        'slug',
        'short_description',
        'description',
        'product_id',
        'image_one',
        'image_two',
        'image_three',
        'status',

 
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
