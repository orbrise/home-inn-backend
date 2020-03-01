<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupattribute extends Model
{
    protected $fillable = [
          'shop_id','name','delstatus','created_at','updated_at','created_by',
        //'email', 'password',
    ];


    
}
