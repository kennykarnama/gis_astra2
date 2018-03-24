<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AnalisisData\MyAnalisis;
use DB;

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
        $jumlah_saldo = MyAnalisis::get_jumlah_saldo();

        $jumlah_customer = MyAnalisis::get_jumlah_customer();

        $jumlah_bal7 = MyAnalisis::get_jumlah_bal(7);


        //dd($jumlah_bal7);
    	
        return view('pages.dashboard',
            ['jumlah_saldo'=>$jumlah_saldo,"jumlah_customer"=>$jumlah_customer,
            "jumlah_bal7"=>$jumlah_bal7]);
    }
}
