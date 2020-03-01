<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parentcat;
use App\Models\Groupattribute;
use App\Models\Brand;
use App\Models\Attroption;
use App\Models\Product_attribute;
use App\Models\Product;
use App\Models\ProductImg;
use App\Models\Currency;
use App\Models\Price;
use App\Models\Shipment;
use Auth;
use Image;
use File;

class ProductManage extends Controller
{

    public function index($level = 0, $catid = 0, $shopid = 0, $id = 0)
    {
    	if($level == 0)
    	{
    		$cats = Parentcat::where(['levels' => 0, 'delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
    		$catname = 0;
    	}
    	else {
    		$catname = Parentcat::where(['id' => $id, 'delstatus' => 0])->first();
    		$cats = Parentcat::where(['level_id' => $id, 'delstatus' => 0])->get();
    	}
		
		$groupattrs = Groupattribute::where(['delstatus' => 0, 'shop_id' => Auth::user()->id ])->get();
    	
    	return view('pages.category.index',['level' => $level,
    	                                'cats' => $cats,
    	                                 'catid' => $catid,
    	                                  'shopid' => $shopid,
    	                                   'delstatus' => 0,
    	                                    'catname' => $catname,
    	                                    'id' => $id,
											'groupattrs' => $groupattrs
											]);
    }

    public function AddCat(Request $req)
    {
    	$level = $req->level;
    	$maxcatid = $req->catid;
    	$shopid = $req->shopid;

    	if($level == 0)
    	{
    	    $levelid = 0;
    	} else { $levelid = $req->id;}
        
    	$addcat = new Parentcat;
    	$addcat->cat_id = $maxcatid;
    	$addcat->shop_id = Auth::user()->id;
    	$addcat->name = $req->catname;
        $addcat->slug =$this->slugify($req->catname);
    	$addcat->levels = $level;
    	$addcat->level_id = $levelid;
    	$addcat->delstatus = 0;
    	$addcat->created_by = Auth::user()->shop_user;

    	if($req->hasFile('catimg'))
    	{
    		$file = $req->catimg;
    		$ext = $req->file('catimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file);
                $image->save('public/assets/products/catimages/'.$newname, 60);
                $addcat->catimg = $newname;
 
            }
    	}
    	if($addcat->save())
    	{
    		return back();
    	}
    }

	public function slugify($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
			return 'n-a';
		}

		return $text;
	}


    public function EditCat($catid = 0)
    {
    	$editdata = Parentcat::where('id',$catid)->first();
    	return view('pages.category.editcat', ['editdata' => $editdata]);

    }

    public function UpdateCat(Request $req)
    {
		$this->validate($req,[
			'cname' => 'required',
			'slug' => 'required'
		]);
    	$editd = Parentcat::find($req->id);
    	$oldimg = base_path().'/public/assets/products/catimages/'.$editd->catimg;
    	
    	$editd->name = $req->cname;
		$editd->slug = trim($req->slug, '-');
		$editd->longdesc = $req->longdesc;
		$editd->meta_title = $req->meta_title;
		$editd->meta_content = $req->meta_content;
		$editd->keywords = $req->keywords;

    	if($req->hasFile('catimg'))
    	{
    		File::delete($oldimg);
    		$file = $req->catimg;
    		$ext = $req->file('catimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file);

                $image->save('public/assets/products/catimages/'.$newname, 60);
                $editd->catimg = $newname;
 
            }
    	}

    	if($editd->save())
    	{
    		return  back()->with('successmsg', 'Information Successfully Updated ');
    	}

    }

    public function DelCat($id)
    {
    	$del = Parentcat::find($id);
    	$del->delstatus = 1;
    	if($del->save())
    	{
    		return back()->with('successmsg', 'Successfully Inactive');
    	}
    }

    public function Attrs()
    {
    	$allttrs = Groupattribute::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();

    	return view('pages.attributes', ['allttrs' => $allttrs]);
    }

    public function AddNewProduct()
    {
    	if(Auth::check()){
    	$allparents = Parentcat::where(['delstatus' => 0, 'shop_id' => Auth::user()->id, 'levels' => 0])->get();
    	return view('pages.addproduct', ['allparents' => $allparents]);
        } else {return  view('auth.login');}
    }

    public function Brands()
    {
    	$brands = Brand::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
    	return view('pages.brand', ['brands' => $brands]);
    }

    public function AddNewProductPost(Request $req)
    {
    	$status = 0;
    	$prodname = $req->prodname;
    	$url = $req->url;
    	$shotdesc = $req->shortdesc;
    	$longdesc = $req->longdesc;
    	$prod_type = $req->prodtype;
    	$barcode = $req->barcode;
    	$sku = $req->sku;
    	$shippingdays = $req->shippingdays;
    	$price = $req->price;
    	$totalattr = $req->totalattr;
    	$imgid = str_random(25);

        // adding main product information 
    	$prod = new Product;
    	$prod->shop_id = Auth::user()->id;
    	$prod->cat_id = $req->levelcat0;
    	$prod->subcat_id = $req->catlevel1;
    	$prod->subchild_cat = $req->catlevel2;
    	$prod->imgid = $imgid;
    	$prod->title = $req->prodname;
    	$prod->url = $req->url;
    	$prod->brand = $req->brandname;
    	$prod->short_desc =  $req->shortdesc;
    	$prod->long_desc = $req->longdesc;
    	$prod->sku = $req->sku;
    	$prod->barcode = $req->barcode;
    	$prod->qty = $req->qty;
    	$prod->r_price = $req->rprice;
		$prod->d_price = $req->dprice;
    	$prod->delivery_days = $req->shippingdays;
    	$prod->created_by = Auth::user()->shop_user;
    	$prod->keywords = $req->keywords;
    	$prod->meta_title = $req->meta_title;
    	$prod->meta_content = $req->meta_content;
		$prod->tag = $req->tag;
		$prod->product_code = $req->prodcode;

    	if(!empty($totalattr))
    	{
            $prod->is_attr = 1;
    	}
    	
    	if($prod->save()){$status = 1;}
    	$product_id = $prod->id;
		
        if(!empty(Auth::user()->shop_country))
        {
        foreach(explode(',', Auth::user()->shop_country) as $country)
          {
			  if(isset($req[str_replace(' ', '', $country)])){
				  
            $price = $req[str_replace(' ', '', $country)];
			  $dprice = $req[str_replace(' ', '', $country).'_sale'];
			  $price = $price > 0 ? (float)$price : 0;
			  $dprice = $dprice > 0 ? (float)$dprice : null;
            $addprice = Price::firstOrCreate(['prod_id' => $product_id, 'currency' => $country],
				['prod_id' => $product_id, 'currency' => $country, 'price' => $price, 'dprice' => $dprice  ]);
				
			}
          }
        }  


    	
    	//adding Attributes options
    	$data = [];
    	
    	for($i =1; $i<=$totalattr; $i++)
    	{
    		$attrs = Groupattribute::find($req['groupattr'.$i]);
    		$data[] = [

    			'shop_id' => Auth::user()->id,
    			'product_id' => $prod->id,
    			'attrid' => $req['groupattr'.$i],
    			'attr_name' => $attrs->name,
    			'name' => $req['opts'.$i],
				'value' => $req['attrprice'.$i],
				'sale' => $req['attrsale'.$i],
    			'created_by' =>  Auth::user()->shop_user
    		];
    	}

    	$insert = Product_attribute::insert($data);
    	if($insert){$status == 1;}

    	 if(!empty($req->file('prodimage')))
        {

            $path = 'public/assets/product_images/'.$product_id.'/';
            $paththumb = 'public/assets/product_images/'.$product_id.'/thumbs/';

            if(!File::exists($path))
            {
                File::makeDirectory($path, 0775);
            }

            if(!File::exists($paththumb))
            {
                File::makeDirectory($paththumb, 0775);
            }

            foreach($req->file('prodimage') as $key => $img)
                { 
                       $file = $req->prodimage[$key];
                       $ext = $req->prodimage[$key]->getClientOriginalExtension();
                       $newname = Auth::user()->name.date("YmdHis").'.'.$ext;
                       $image = Image::make($file)->resize(800, 800, function($c){
                         $c->aspectRatio();
                       });
                       $image->resizeCanvas(800, 800, 'center', false, '#ecf0f1');
					   if(Auth::user()->id == 9){} else{
                       $watermark = Image::make('public/assets/userslogo/'.Auth::user()->shop_logo)->fit(170);
                       $image->insert($watermark, 'top-right', 10, 10);
					   $image->text($req->prodcode, 750, 150, function($font){
                       $font->file('public/assets/fonts/Roboto-Bold.ttf');
                         $font->size(30);
                         $font->color('#000000');
                         $font->align('right');
                         $font->valign('top');
                       });
					   }
                       $image->save($path.$newname, 50);
                       $image = Image::make($file)->fit(400)->save($paththumb.$newname, 60);
                       $addimg = new ProductImg;
                       $addimg->product_id = $product_id;
                       $addimg->img_code = $imgid;
                       $addimg->location = $path;
                       $addimg->file_name = $newname;
                       $addimg->color = 'default';
                       if($key == 0){$addimg->coverimg = 1;}
                       $addimg->save();

                }
        }


        if($status == 1)
        {
        	return redirect('customers/products')->with('successmsg', 'Product Added Successfully');
        }
    }


    public function AllProducts()
    {
    	$prods = Product::where(['shop_id' => Auth::user()->id])->paginate(20);
    	return view('pages.products', ['prods' => $prods]);
    }

    public function FeaturedProducts()
    {
        $prods = Product::where(['shop_id' => Auth::user()->id, 'is_featured' => 'yes'])->paginate(20);
        return view('pages.products', ['prods' => $prods]);
    }

    public function EditProduct($prod_id)
    {
    	$editdata = Product::find($prod_id);
        $prices = Price::where(['delstatus' => 0])->get();
    	$groupattrs = Groupattribute::where(['shop_id' => Auth::user()->id, 'delstatus' => 0])->get();
    	$brands = Brand::where(['shop_id' => Auth::user()->id, 'delstatus' => 0])->get();
    	$pcats = Parentcat::where(['shop_id' => Auth::user()->id, 'delstatus' => 0, 'levels' => 0])->get();
    	return view('pages.editproduct', ['editdata' => $editdata,
    	                                  'groupattrs' => $groupattrs,
    	                                   'brands' => $brands,
    	                                   'allparents' => $pcats, 'prices' => $prices]);
    }


    public function EditProductInfo(Request $req)
    {

		//dd($req->all());
    	
    	$status = 0;
    	$prodname = $req->prodname;
    	$url = $req->url;
    	$shotdesc = $req->shortdesc;
    	$longdesc = $req->longdesc;
    	$prod_type = $req->prodtype;
    	$barcode = $req->barcode;
    	$sku = $req->sku;
    	$shippingdays = $req->shippingdays;
    	$price = $req->price;
    	$totalattr = $req->totalattr;
    	$imgid = str_random(25);


        // adding main product information 
    	$prod = Product::find($req->prod_id);
    	$prod->cat_id = $req->levelcat0;
    	$prod->subcat_id = $req->catlevel1;
    	$prod->subchild_cat = $req->catlevel2;
    	$prod->imgid = $imgid;
    	$prod->title = $req->prodname;
    	$prod->url = $req->url;
    	$prod->brand = $req->brandname;
    	$prod->short_desc =  $req->shortdesc;
    	$prod->long_desc = $req->longdesc;
    	$prod->sku = $req->sku;
    	$prod->barcode = $req->barcode;
    	$prod->qty = $req->qty;
    	$prod->r_price = $req->rprice;
		$prod->d_price = $req->dprice;
    	$prod->delivery_days = $req->shippingdays;
    	$prod->created_by = Auth::user()->shop_user;
    	$prod->keywords = $req->keywords;
    	$prod->meta_title = $req->meta_title;
    	$prod->meta_content = $req->meta_content;
		$prod->tag = $req->tag;
		$prod->product_code = $req->prodcode;
    	if(!empty($totalattr))
    	{
            $prod->is_attr = 1;
    	}
    	
    	if($prod->save()){$status = 1;}
    	$product_id = $prod->id;
		$prices = array();
        if(!empty(Auth::user()->shop_country))
        {
        foreach(explode(',', Auth::user()->shop_country) as $country){
			
			  if(isset( $req[str_replace(' ', '', $country)])){
				$price = $req[str_replace(' ', '', $country)];
				$dprice = $req[str_replace(' ', '', $country).'_sale'];
				$price = $price > 0 ? (float)$price : 0;
				$dprice = $dprice > 0 ? (float)$dprice : null;
				// $prices[] = array($price, $dprice);
				$addprice = Price::firstOrNew(['prod_id'=>$product_id, 'currency'=>$country]);
				$addprice->price = $price;
				$addprice->dprice = $dprice;
				$addprice->save();
			  }
          }
        }
		//dd($prices);
    	
    	//adding Attributes options
    	$data = [];
    	
    	for($i =1; $i<=$totalattr; $i++)
    	{
    		$attrs = Groupattribute::find($req['groupattr'.$i]);
    		$data[] = [

    			'shop_id' => Auth::user()->id,
    			'product_id' => $prod->id,
    			'attrid' => $req['groupattr'.$i],
    			'attr_name' => $attrs->name,
    			'name' => $req['opts'.$i],
				'value' => $req['attrprice'.$i],
				'sale' => $req['attrsale'.$i],
    			'created_by' =>  Auth::user()->shop_user
    		];
		}
		
		//dd($data);

    	$insert = Product_attribute::insert($data);
    	if($insert){$status == 1;}
		
    	 if(!empty($req->file('prodimage')))
        {

            $path = 'public/assets/product_images/'.$product_id.'/';
            $paththumb = 'public/assets/product_images/'.$product_id.'/thumbs/';

            if(!File::exists($path))
            {
                File::makeDirectory($path, 0775);
            }

            if(!File::exists($paththumb))
            {
                File::makeDirectory($paththumb, 0775);
            }

            foreach($req->file('prodimage') as $key => $img)
                { 
                       $file = $req->prodimage[$key];
                       $ext = $req->prodimage[$key]->getClientOriginalExtension();
                       $newname = Auth::user()->name.date("YmdHis").'.'.$ext;
                       $image = Image::make($file)->resize(800, 800, function($c){
                         $c->aspectRatio();
                       });
                       $image->resizeCanvas(800, 800, 'center', false, '#ecf0f1');
					   if(Auth::user()->id == 9){} else{
                       $watermark = Image::make('public/assets/userslogo/'.Auth::user()->shop_logo)->fit(170);
					   $image->insert($watermark, 'top-right', 10, 10);
					   $image->text(ucwords($req->prodcode), 750, 150, function($font){
                         $font->file('public/assets/fonts/Roboto-Bold.ttf');
                         $font->size(30);
                         $font->color('#000000');
                         $font->align('right');
                         $font->valign('top');
                        // $font->angle(90);
                       });
					   }
                       
                       $image->save($path.$newname, 50);
                       $image = Image::make($file)->fit(400,400)->save($paththumb.$newname, 60);
                       $addimg = new ProductImg;
                       $addimg->product_id = $product_id;
                       $addimg->img_code = $imgid;
                       $addimg->location = $path;
                       $addimg->file_name = $newname;
                       $addimg->color = 'default';
                       if($key == 0){$addimg->coverimg = 1;}
                       $addimg->save();

                }
        }


        if($status == 1)
        {
        	return redirect('customers/products')->with('successmsg', 'Product Added Successfully');
        }
    }


		public function AddNewBrand(Request $req)
		{
			$newname = '';
			if($req->hasFile('brandlogo'))
    	{
    		$file = $req->brandlogo;
    		$ext = $req->file('brandlogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file)->fit(50);

                $image->save('public/assets/brands/'.$newname, 60);
            }
    	}

			$addbrand = Brand::firstOrCreate(['shop_id' => Auth::user()->id, 'name' => $req->brandname],
			                                  ['shop_id' => Auth::user()->id, 'name' => $req->brandname,
			                                    'logo' => $newname, 'created_by' => Auth::user()->shop_user]);
			return back()->with('successmsg', 'Successfully Added');

		}

		public function DellBrand($id = 0)
		{
			$dell = Brand::find($id);
			$dell->delstatus = 1;
			if($dell->save())
			{
				return back()->with('successmsg', 'Successfully Deleted');
			}
		}

		public function DellProd($id = 0)
		{
			$dell = Product::find($id);
			$dell->delstatus = 1;
			if($dell->save())
			{
				return back()->with('successmsg', 'Successfully Inctive');
			}
		}

		public function ActivateProd($id = 0)
		{
			$dell = Product::find($id);
			$dell->delstatus = 0;
			if($dell->save())
			{
				return back()->with('successmsg', 'Successfully Activate');
			}
		}

        public function CurrencyChanger()
        {
            $conversions = Currency::where(['del_status' => 0])->where('rate', '!=', '')->get();
            $currencies = Currency::where(['del_status' => 0])->get();
            return view('pages.currencychanger', ['currencies' => $currencies, 'conversions' => $conversions]);
        }

        public function AddNewConversion(Request $req)
        {
            $upd = Currency::find($req->covertedto);
            $upd->rate = $req->tobeconverted;
            $upd->save();
            return back()->with('successmsg', 'New Conversion Added');
        }

        public function DeleteConv($convid)
        {
            $upd = Currency::find($convid);
            $upd->rate = '0';
            $upd->save();
            return back()->with('successmsg', 'Conversion Deleted');
        }

public function ShipmentCharges()
        { 
            $rates = Shipment::where(['shop_id' => Auth::user()->id, 'delstatus' => 0])->get();
             $countries = Currency::where(['del_status' => 0])->orderBy('country')->get();
             return view('pages.shipmentcharges', ['countries' => $countries, 'rates' => $rates]);
        }

        public function AddShipment(Request $req)
        {   $shopid = Auth::user()->id ;
            $new = Shipment::firstOrCreate([
                'shop_id' => $shopid, 'country' => $req->country, 'delstatus' => 0],
                ['shop_id' => $shopid, 'country' => $req->country, 
                'normal_rates' => $req->normal_rates, 'urgent_rates' => $req->urgent_rates ]);

            if($new->save())
            {
                return back()->with('successmsg', 'Successfully Addedd!');

            } else 
            {
                return back()->with('errormsg', 'Error Try Again!');
            }
        }


        public function DellShipment($id)
        {
            $upd = Shipment::find($id);
            $upd->delstatus = '1';
            $upd->save();
            return back()->with('successmsg', 'Shipment Rate Deleted');
        }

}
