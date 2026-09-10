<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
   

    // Define the table name (optional if the name follows Laravel conventions)
    protected $table = 'shipping_charges';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'charge',
    ];

    // Optionally, you can define the timestamps if you want to customize
    public $timestamps = true; // This is the default, so it's optional.

    // If you want to add any custom methods, you can do that here
}