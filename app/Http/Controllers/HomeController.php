<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Currency;
use Image;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Parentcat;
use App\Models\Blog;
use App\Models\Vendor;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
    	if(Auth::check())
    		{
    			
    			return view('pages.dashboard');

    		}
    		
    		else { return redirect('/customers'); }
    }

    public function ViewCompanySetting()
    {
    	$allcur = Currency::where(['del_status' => 0])->get();
    	return view('pages.companysetting',['allcur' => $allcur]);
    }

    public function SaveCompanyData(Request $req)
    {
		if(!empty($req->pass)){
		Validator::make($req->all(),[
            'pass' => 'required|min:6',
            'rpass' => 'required|same:pass'

        ])->setAttributeNames(['sname' => 'Shop Name', 'soame' => 'Shop Owner Name' , 'pass' => 'Password', 'rpass' => 'Repeat Password'])->validate();
		}


    	$companyinfo = Shop::find($req->id);
    	$companyinfo->shop_name = $req->sname;
    	$companyinfo->shop_city = $req->city;
		if(!empty($req->country)){
    	$companyinfo->shop_country = implode(',', $req->country);
		}
    	$companyinfo->shop_owner = $req->soname;
    	$companyinfo->address = $req->address;
    	$companyinfo->currency = $req->currency;

    	if($req->hasFile('shoplogo'))
    	{
    		$file = $req->shoplogo;
    		$ext = $req->file('shoplogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
            	$newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file)->resize(300, 300, function($c){$c->aspectRatio();});
                $image->save('public/assets/userslogo/'.$newname);
                $companyinfo->shop_logo = $newname;
 
            }
    	}
		 
		if(!empty($req->pass))
		{
			$companyinfo->password = bcrypt($req->pass);
		}
		
    	if($companyinfo->save())
    	{
    		return back()->with('successmsg', 'Your Company Information Successfully Updated');
    	}

    }

    public function LogOut()
    {
    	Auth::logout();
    	return redirect('/customers');
    }

    public function Orders()
    {

        $orders = Order::where(['customer'=> Auth::user()->shop_user, 'status' => 0])->select('order_no','customer','created_at','currency', 'process_level')
        ->groupBy('order_no','customer','created_at','currency', 'process_level')->get();
        
        return  view('pages.orders.orders', ['orders' => $orders]);
    }

    public function OrderView($orderno = '')
    {
        if($orderno == '')
        {
            return redirect('/customers');
        }
        else {

            $orderf = Order::where(['status' => 0, 'order_no' => $orderno])->first();
            $orders = Order::where(['status' => 0, 'order_no' => $orderno])->get();

            return  view('pages.orders.orderview', ['error' => 0, 'orderf' => $orderf, 'orders' => $orders]);
        }
    }

    public function UpdateOrderStatus(Request $req)
    {
        
         
        if($req->status == 1 ) 
        {
            $upd = Order::where(['order_no' => $req->orderno, 'status' => 0])->update([

                'process_level' => 1,
                'process' => 'Pending' 
            ]);
            
        }

        if($req->status == 2 ) {

             $upd = Order::where(['order_no' => $req->orderno, 'status' => 0])->update([

                'process_level' => 2,
                'process' => 'Process' 
            ]);
        }

        if($req->status == 3 ) 
        {
            $upd = Order::where(['order_no' => $req->orderno, 'status' => 0])->update([

                'process_level' => 3,
                'process' => 'Ready for Shippment' 
            ]);
        }

        if($req->status == 4 ) {

            $upd = Order::where(['order_no' => $req->orderno, 'status' => 0])->update([

                'process_level' => 4,
                'process' => 'Delivered to Shipper' 
            ]);
        }
        if($req->status == 5 ) {

            $upd = Order::where(['order_no' => $req->orderno, 'status' => 0])->update([

                'process_level' => 5,
                'process' => 'Delivered to Customer' 
            ]);

        }


            return back()->with('successmsg', 'Status Updated!');
        
    }

    public function Blogs()
    {
        $blogs = Blog::where(['shop_id' => Auth::user()->id])->get();
         return  view('pages.blogs.blogs', ['blogs' => $blogs]);
    }

    public function NewBlog()
    {
        $cats = Parentcat::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
         return  view('pages.blogs.newblogs', ['allparents' => $cats]);
    }

    public function NewPost(Request $req)
    {
        $new = new Blog;
        $new->shop_id = Auth::user()->id;
        $new->title = $req->title;
        $new->url = str_replace(' ', '-', $req->title);
        $new->short_desc = $req->short_desc;
        $new->description = $req->long_desc;
        $new->category = $req->cat;
        $new->tag = $req->tag;
        if($req->hasFile('fimg'))
        {
            $path = 'public/assets/blogimages/';
            $file = $req->fimg;
            $ext = $req->file('fimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
                
                $newname = Auth::user()->id.date("His").'.'.$ext;
                $filename = $path.$newname;
                $image = Image::make($file)->fit(800);
                $image->save($path.$newname, 60);
                $new->blogimg = $filename;

 
            }
             else {return back()->with('errormsg', 'Please select an image only');}
        }
        

        if($new->save())
        {
            return back()->with('successmsg', 'New Post Published');
        }
        
    }


    public function EditPost($id = '')
    {
        $cats = Parentcat::where(['delstatus' => 0, 'shop_id' => Auth::user()->id])->get();
        $blog = Blog::find($id);
        return view('pages.blogs.editblog', ['blog' => $blog, 'allparents' => $cats]);
    }

    public function UpdatePost(Request $req)
    {
        $new = Blog::find($req->id);
        $new->title = $req->title;
        $new->url = str_replace(' ', '-', $req->title);
        $new->short_desc = $req->short_desc;
        $new->description = $req->long_desc;
        $new->category = $req->cat;
        $new->tag = $req->tag;
        if($req->hasFile('fimg'))
        {
            $path = 'public/assets/blogimages/';
            $file = $req->fimg;
            $ext = $req->file('fimg')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
                
                $newname = Auth::user()->id.date("His").'.'.$ext;
                $filename = $path.$newname;
                $image = Image::make($file)->fit(800);
                $image->save($path.$newname, 60);
                $new->blogimg = $filename;

 
            }
            else {return back()->with('errormsg', 'Please select an image only');}
        }
         

        if($new->save())
        {
            return back()->with('successmsg', ' Post Updated ');
        }
    }

    public function InactivePost($id='')
    {
        
        $upd = Blog::find($id);
        $upd->delstatus = 1;
        if($upd->save())
        {
            return back()->with('successmsg', 'Post has been inactive');
        }
    }

    public function ActivePost($id='')
    {
        
        $upd = Blog::find($id);
        $upd->delstatus = 0;
        if($upd->save())
        {
            return back()->with('successmsg', 'Post has been Active');
        }
    }

    public function Vendors()
    {
        $vendors = Vendor::where(['del_status' => 0, 'shop_id' => Auth::user()->id])->get();
        return view('pages.vendors.vendors', ['vendors' => $vendors]);
    }

    public function NewVendor()
    {
        return view('pages.vendors.newvendor');
    }

     public function AddNewVendor(Request $req)
    {
        Validator::make($req->all(),[
            'svname' => 'required|string|unique:vendors,shop_name',
            'vname' => 'required|string',
            'email' => 'required|email|unique:vendors,username',
            'pass' => 'required|min:6',
            'rpass' => 'required|same:pass'

        ])->setAttributeNames(['svname' => 'Shop Name', 'vname' => 'Vendor Name', 'pass' => 'Password', 'rpass' => 'Repeat Password'])->validate();


        $vendor = new Vendor;
        $vendor->shop_id = Auth::user()->id;
        $vendor->shop_name = $req->svname;
        $vendor->vendor_name = $req->vname;
        $vendor->vendor_city = $req->city;
        $vendor->vendor_country = $req->country;
        
        $vendor->address = $req->address;
        $vendor->currency = $req->currency;
        if($req->hasFile('shoplogo'))
        {
            $file = $req->shoplogo;
            $ext = $req->file('shoplogo')->getClientOriginalExtension();
            if($ext == 'jpg' or $ext == 'png' or $ext == 'jpeg')
            {
                $newname = Auth::user()->id.date("His").'.'.$ext;
                $image = Image::make($file)->resize(300, 300);
                $image->save('public/assets/vendors_logo/'.$newname, 60);
                $vendor->vendor_logo = $newname;
 
            }
        }
         $vendor->username = $req->email;
         $vendor->password = bcrypt($req->pass);
        if($vendor->save())
        {
            return back()->with('successmsg', 'New Vendor has been added');
        }
    }
}
