<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AnalisisData\MyAnalisis;
use App\AnalisisData\Kecamatan;
use App\AnalisisData\Kelurahan;
use App\AnalisisData\Arho;

class VisualisasiDataController extends Controller
{
    //

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');

        ini_set('memory_limit', '-1');
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
    		"0" => 'red_dot.png',
    		"1" => 'green_dot.png'
    		);

    	$customer_markers = MyAnalisis::fetch_customer_markers($icon);

        //dd($customer_markers);

    	return response()->json($customer_markers);
    }

    public function fetch_arho_markers(Request $request)
    {
        # code...
        $list_kecamatan = MyAnalisis::fetch_object_kecamatan();

        $list_arho = MyAnalisis::fetch_object_arho();

        return response()->json($list_arho);
    }


}
