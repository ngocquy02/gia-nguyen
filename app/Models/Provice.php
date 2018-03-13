<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provice extends Model
{
    protected $table = 'provice';
    protected $guarded = [];

    public function district()
    {
        return $this->hasMany('App\Models\District','ProviceId','id');
    }
}
