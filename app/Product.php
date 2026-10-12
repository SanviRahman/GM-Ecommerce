<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** Customer-facing listings should never render inactive catalog entries. */
    public function scopeVisible($query)
    {
        return $query->where('status', 'Active');
    }

    // Many-to-Many relationship with Color
    public function colors()
    {
        //return $this->belongsToMany(Color::class, 'product_color');
        return $this->belongsToMany('App\Color')->withTimestamps();
    }

    // Many-to-Many relationship with Size
    public function sizes()
    {
        return $this->belongsToMany('App\Size')->withTimestamps();
    }
    public function options()
    {
        return $this->belongsToMany('App\Option', 'option_product') // Specify the pivot table
                    ->withPivot('price') // Include the 'price' field in the pivot table
                    ->withTimestamps();
    }
    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function media(){
        return $this->belongsToMany('App\Media')->withTimestamps();
    }

    public function order(){
        return $this->belongsToMany('App\Order')->withTimestamps();
    }

    /** Current inventory row maintained by Purchase/Order controllers. */
    public function stockRecord()
    {
        return $this->hasOne(Stock::class, 'product_id');
    }

    public function availableStock()
    {
        return max(0, (int) optional($this->stockRecord)->stock);
    }

    public function isSoldOut()
    {
        return (int) $this->isStockOut === 1 || $this->availableStock() <= 0;
    }

    /** Discount badge percentage, only for a genuine lower sale price. */
    public function salePercentage()
    {
        $regular = (float) $this->productRegularPrice;
        $sale = (float) $this->productSalePrice;
        return $regular > 0 && $sale > 0 && $sale < $regular
            ? (int) round((($regular - $sale) / $regular) * 100)
            : 0;
    }

    public function url()
    {
        return url('product/'.$this->ProductSlug.'/'.$this->id);

    }
    public function price()
    {
        if($this->productSalePrice > 0){
            return $this->productSalePrice;
        }else{
            return $this->productRegularPrice;
        }
    }
    public function htmlPrice()
    {
        $sale = (float) $this->productSalePrice;
        $regular = (float) $this->productRegularPrice;
        if ($sale > 0 && $regular > 0 && $sale < $regular) {
            return '<span class="leatherket-price-line"><span class="product-price">৳ '
                . number_format($sale, 2) . '</span><del class="product-price-old">৳ '
                . number_format($regular, 2) . '</del></span>';
        }
        $price = $sale > 0 ? $sale : $regular;
        return '<span class="leatherket-price-line"><span class="product-price">৳ '
            . number_format($price, 2) . '</span></span>';
    }
}
