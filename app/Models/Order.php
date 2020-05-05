<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shoppingCartItems()
    {
        return $this->hasMany('App\Models\ShoppingCartItem');
    }
}
