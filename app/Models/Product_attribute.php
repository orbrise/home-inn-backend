<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    protected $fillable = [

    		'shop_id', 'product_id','attrid','attr_name','name','value','delstatus','created_at','updated_at','created_by',

    ];

    public function attrOpts()
    {
    	return $this->hasMany(Attroption::class, 'attrgroup', 'attrid');
    }
}
