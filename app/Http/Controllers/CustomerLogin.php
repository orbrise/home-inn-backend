<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoLogin;
use Auth;
use App\User;

class CustomerLogin extends Controller
{
    public function index()
    {
        if(Auth::check()){ return redirect('customers/dashboard'); }
            else {
                return view('auth.login');
            }
    	
    }

    public function MakeLogin(DoLogin $req)
    {

    	$username = $req->username;
         $pass = $req->password;

    	if(Auth::attempt(['shop_user' => $username, 'password' => $pass]))
    		{
    			return redirect('customers/dashboard');
    		}

    		else 
    			{
    				return back()->with('errormsg', 'Username/Password is Wrong');
    		    }
    	
    	
    }
}
