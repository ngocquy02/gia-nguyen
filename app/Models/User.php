<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = [];

    public function article()
    {
        return $this->hasMany('App\Models\Article','CreateBy','id');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product','CreateBy','id');
    }
}
