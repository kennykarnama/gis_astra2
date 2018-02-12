<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AnalisisData\MyAnalisis;
class VisualisasiDataController extends Controller
{
    //

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');
    }

    public function umum()
    {
    	# code...

    	return view('pages.visualisasi_data_umum',[]);
    }

    public function fetch_customer_markers(Request $request)
    {
    	# code...
    	$icon = array(
    		0 => 'red_dot.png',
    		1 => 'green_dot.png'
    		);

    	$customer_markers = MyAnalisis::fetch_customer_markers($icon);

    	return response()->json($customer_markers);
    }


}
