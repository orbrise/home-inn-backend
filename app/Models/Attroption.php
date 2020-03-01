<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attroption extends Model
{
  protected $fillable = [
  	
    	'shop_id','attrgroup','name','value','delstatus','created_at','updated_at','created_by',
    ];
}
