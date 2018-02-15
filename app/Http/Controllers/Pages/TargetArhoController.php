<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TargetArhoController extends Controller
{
    //
    public function __construct(Request $request)
    {
    	# code...
    	$this->middleware('auth:admin');


    }

    public function index()
    {
    	# code...
    	return view('pages.target_arho',[]);
    }
}
