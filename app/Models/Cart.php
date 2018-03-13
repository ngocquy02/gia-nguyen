<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = [];
	public function partner()
    {
        return $this->belongsTo('App\Models\Partner','PartnerBy','id');
    }
}
