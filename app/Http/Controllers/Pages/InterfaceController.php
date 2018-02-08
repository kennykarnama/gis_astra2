<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class InterfaceController extends Controller
{
    //

    public function __construct()
    {
        # code...
        $this->middleware('auth:admin');
    }
    public function test_login()
    {
    	# code...
    	return view('pages.signin');
    }

    public function test_dashboard()
    {
    	# code...
    	return view('pages.dashboard');
    }
}
