<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name', 'description', 'price'];

    public function shoppingCartItems() {
        return $this->hasMany('\App\Models\ShoppingCartItem');
    }
}
