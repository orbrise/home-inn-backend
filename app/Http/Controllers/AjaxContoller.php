<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupattribute;
use App\Models\Attroption;
use App\Models\Parentcat;
use App\Models\Brand;
use App\Models\Product_attribute;
use App\Models\ProductImg;
use App\Models\Product;
use Auth;
use File;

class AjaxContoller extends Controller
{
    public function CreateAttr(Request $req)
    {
    	$addattr= Groupattribute::firstOrCreate(['name' => $req->attrname, 'shop_id' => Auth::user()->id, 'delstatus' => 0], ['shop_id' => Auth::user()->id, 'name' => $req->attrname ,'created_by' => Auth::user()->shop_user]) ;

    	$allttrs = Groupattribute::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
    	return view('ajax.ajaxpages.productajax', ['allatrs' => $allttrs ]);

    }

    public function GetAttrVal(Request $req)
    {
    	$getattroptions = Attroption::where(['delstatus' => 0, 'shop_id' => Auth::user()->id, 'attrgroup' => $req->attrid])->get();
    	return view('ajax.ajaxpages.productajax', ['getattropts' => $getattroptions ]);
    }

    public function SaveOptionVal(Request $req)
    {

        $addattroption= Attroption::firstOrCreate(['name' => $req->value, 'value' => $req->color, 'shop_id' => Auth::user()->id, 'attrgroup' =>$req->attrid,  'delstatus' => 0], ['shop_id' => Auth::user()->id, 'attrgroup' =>$req->attrid , 'name' => $req->value ,'value' => $req->color, 'created_by' => Auth::user()->shop_user]) ;
        if($addattroption)
        {
            return 'successfully Added';
        }
    }

    public function UpdateOptionVal(Request $req)
    {

        $updateattroption= Attroption::find($req->id);
        $updateattroption->name = $req->value;
        $updateattroption->value = $req->color;
        if($updateattroption->save())
        {
            return 'successfully Added';
        }
    }

    public function DeleteGroupAttr(Request $req)
    {
        $req->id;
        $delattr = Groupattribute::find($req->id);
        $delattr->delstatus = 1;
        $delattr->save();
    }

    public function DeleteAttrOption(Request $req)
    {
        $delattropt = Attroption::find($req->optionid);
        $delattropt->delstatus = 1;
        $delattropt->save();
    }

   public function GetLevel1(Request $req)
   {
       $catpid = $req->catid;
       $level = $req->level;
       $levels1 = Parentcat::where(['delstatus' => 0, 'shop_id' => Auth::user()->id, 'level_id' => $catpid])->get();
       return view('ajax.ajaxpages.productajax', ['levels1' => $levels1, 'level' => $level]);
   }

   public function AppendAttr(Request $req)
   {
       $at = $req->at;
       $groupattrs = Groupattribute::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
       return view('ajax.ajaxpages.productajax', ['groupattrs' => $groupattrs, 'at' => $at]);
   }

   public function Getoptions(Request $req)
   {
       $opts = Attroption::where(['delstatus' => 0, 'shop_id' => Auth::user()->id, 'attrgroup' => $req->attrid ])->get();
       return view('ajax.ajaxpages.productajax', ['opts' => $opts, 'at' => $req->at]);
   }

   public function AppendBrand()
   {
       $allbrands = Brand::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
       return view('ajax.ajaxpages.productajax', ['allbrands' => $allbrands]);
   }

   public function DelAttr(Request $req)
   {
       $del = Product_attribute::find($req->prodid);
       $del->delstatus = 1;
       $del->save();
   }

   public function CoverImg(Request $req)
   {
       $upd = ProductImg::where(['delstatus' => 0, 'product_id' => $req->prodid])->update(['coverimg' => 0]);
      $upd1 = ProductImg::where('id', $req->imgid)->update(['coverimg' => 1]);
   }

   public function DelImg(Request $req)
   {
       $upd1 = ProductImg::where('id', $req->imgid)->update(['delstatus' => 1]);
       $imgid = ProductImg::find($req->imgid);
       $img = $imgid->location.$imgid->file_name;
       File::delete($img);
   }

   public function SaveAttr(Request $req)
   {
       if(empty($req->attrname1)) {$attrnameo = $req->attrname2;} elseif (empty($req->attrname2)){$attrnameo = $req->attrname1;}
       $attrname = Groupattribute::find($req->attrid);
       $sav = Product_attribute::find($req->prodid);
       $sav->attrid = $req->attrid ;
       $sav->attr_name = $attrname->name;
       $sav->name = $attrnameo;
       $sav->value = $req->attrvalue;
       if($sav->save()){return 'success';} else {return 'error';}
   }


   public function SearchProduct(Request $req)
   {
       $key = $req->keyword;
       $searchprods = Product::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])
	                         ->where('title', 'like', '%'.$key.'%')
                           ->get();
       return view('ajax.ajaxpages.productajax', ['searchprods' => $searchprods]);
   }

   public function FeaturedProduct(Request $req)
   {
     $is = $req->is;
     
     $upd = Product::find($req->data);
     if($is == 1){
     $upd->is_featured = 'yes';
      }
      else{
        $upd->is_featured = 'no';
      }

      $upd->save();
   }
   
   public function UpdateCatGroup(Request $req)
   {
	   $gup = Parentcat::find($req->id);
	   $gup->group_attr = $req->data;
	   if($gup->save())
	   {
		   return 'Updated';
	   } else 
	   {
		   return 'error';
	   }
   }
   
   public function UpdateCurl(Request $req)
   {
	   $updc = Parentcat::find($req->id);
	   $updc->slug = $req->value; 
	   if($updc->save())
	   {
		   return 'Updated';
	   } else 
	   {
		   return 'error';
	   }
   }

}
