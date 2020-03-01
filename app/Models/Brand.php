<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [

    	'shop_id', 'name', 'description', 'logo', 'delstatus', 'created_at', 'updated_at', 'created_by',

    ];
}
