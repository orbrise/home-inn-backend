<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [

    	'shop_id', 'order_no', 'customer', 'product_id','product_name',	'qty', 'currency'	,'price', 'total', 'process', 'process_level', 'status' , 'address', 'city', 'country', 'phone',
    ];
    
     public function CountOrders()
   {
   	  return $this->hasMany(Order::class, 'order_no', 'order_no');
   }

   public function SumOrders()
   {
   	  return $this->hasMany(Order::class, 'order_no', 'order_no');
   }

   public function CustInfo()
   {
       return $this->hasOne(Customer::class, 'email', 'customer');
   }

   public function ProdImg()
   {
     return $this->hasOne(ProductImg::class, 'product_id', 'product_id');
   }
}
