<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'banner_title',
        'video',
        'banner',
        'slug',
        'short_description',
        'description',
        'product_id',
        'phone_number',
        'whatsapp_number',
        'image_one',
        'image_two',
        'image_three',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Backward-compatible primary product relation.
     * product_id always stores the first selected campaign product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * All campaign products in the exact order selected by the admin.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_product')
            ->withPivot('position')
            ->withTimestamps()
            ->orderBy('campaign_product.position', 'asc');
    }
}
