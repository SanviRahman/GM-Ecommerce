<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
        if($this->productSalePrice > 0){
            return '<div class="product-price-old">
                    <del>
                        ৳ '.number_format($this->productRegularPrice).'
                    </del>
                    <span class="product-price">
                            <strong>
                                ৳ '.number_format($this->productSalePrice).'
                            </strong>
                        </span>
                </div>';
        }else{
            return '<div class="product-price-old">
                        <span class="product-price">
                                <strong>
                                    ৳ '.number_format($this->productRegularPrice).'
                                </strong>
                            </span>
                    </div>';

        }
    }
}
