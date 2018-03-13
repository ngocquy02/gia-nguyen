<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','CatId','id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','CreateBy','id');
    }
}
