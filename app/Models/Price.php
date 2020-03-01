<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = 
    [
    	'prod_id','country','currency','price','dprice','delstatus',
    ];
}
