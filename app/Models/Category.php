<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $guarded = [];

    public function articles()
    {
        return $this->hasMany('App\Models\Article','CatId','id');
    }
    public function products()
    {
        return $this->hasMany('App\Models\Product','CatId','id');
    }
    public function categorys()
    {
        return $this->hasMany('App\Models\Category','ParentID','id');
    }

}
