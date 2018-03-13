<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','CatId','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','CreateBy','id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage','ProdId','id');
    }
}
