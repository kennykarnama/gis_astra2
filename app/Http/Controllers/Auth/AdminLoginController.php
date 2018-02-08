<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AdminLoginController extends Controller
{
    //

    public function __construct(){
    	$this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
    	# code...
    	return view('auth.signin');
    }

    public function login(Request $request)
    {
    	# code...
    	$USERNAME =  $request->username;

    	$password = $request->password;

    	$this->validate($request,
    		
    		['username'=>'required',
    		'password'=>'required'
    		]

    		);

    	// check in database using auth attemp

    	$valid = Auth::guard('admin')->attempt(['username'=>$USERNAME,'password'=>$password]);

    	if($valid){

    		
    		
    		return redirect()->intended(route('admin.dashboard'));
    	
    	}

    	else{
    		return redirect()->back()->withInput($request->only('username'));
    	}

    }

    public function logout()
    {
        # code...
        Auth::logout();

         Session::flush();

        return redirect('/admin/login');
    }


}

