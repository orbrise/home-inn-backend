<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = 
    [
    	'shop_id','country', 'normal_rates', 'urgent_rates',
    ];
}
