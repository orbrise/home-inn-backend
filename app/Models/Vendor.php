<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    public function CountProds()
    {
    	return $this->hasMany(Product::class, 'vendor_id', 'vendor_id');
    }

    public function CountOrders()
    {
    	return $this->hasMany(Order::class, 'vendor_id', 'vendor_id');
    }
}
