<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    public function ProdSingleImg()
    {
    	return $this->hasOne(ProductImg::class, 'product_id', 'id')->where(['delstatus' => 0, 'coverimg' => 1]);
    }

    public function PCatName()
    {
    	return $this->hasOne(Parentcat::class, 'id', 'cat_id');
    }

    public function SCatName()
    {
    	return $this->hasOne(Parentcat::class, 'id', 'subcat_id');
    }

    public function SCCatName()
    {
    	return $this->hasOne(Parentcat::class, 'id', 'subchild_cat');
    }

    public function Attrs()
    {
        return $this->hasMany(Product_attribute::class, 'product_id', 'id')->where(['shop_id' => Auth::user()->id,
                                                                                    'delstatus' => 0]);
    }

    public function Pcat()
    {
        return $this->hasMany(Parentcat::class, 'level_id', 'cat_id');
    }

    public function Scat()
    {
        return $this->hasMany(Parentcat::class, 'level_id', 'subcat_id');
    }

    public function AllProductImgs()
    {
        return $this->hasMany(ProductImg::class, 'product_id', 'id')->where('delstatus', 0);
    }


    public function prices()
    {
        return $this->hasMany(Price::class, 'prod_id', 'id')->where('delstatus', 0);
    }



}
