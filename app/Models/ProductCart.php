<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    protected $table = 'product_cart';
    protected $guarded = [];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart','CartId','id');
    }
}
