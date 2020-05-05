<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $fillable = ['order_id', 'pizza_id', 'pizza_quantity'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function pizza()
    {
        return $this->belongsTo('App\Models\Pizza');
    }
}
