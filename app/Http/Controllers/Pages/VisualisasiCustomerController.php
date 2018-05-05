<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

/**
* 
*/
class Customer  
{
    
    
}
class VisualisasiCustomerController extends Controller
{
    //

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');
    }

    public function indexHome()
    {
    	# code...
    	return view('pages.visualisasi_customer');
    }

    public function fetch_markers(Request $request)
    {
        # code...

        $query_report_handling = DB::table('report_handling')
                                 ->where('report_handling.status_report_handling','=',1)
                                 ->get();

        $markers_customer = array();


        foreach ($query_report_handling as $report_handling) {
            # code...
            $customer_obj = new Customer;

            $customer_obj->agreement = $report_handling->agreement;

            $customer_obj->nama_customer = $report_handling->nama_cust;

            $customer_obj->nama_arho = $report_handling->arho;

            $customer_obj->saldo = $report_handling->saldo;

            $query_arho = DB::table('arho')
                          ->where('arho.is_aktif','=',1)
                          ->where('arho.nama_lengkap','LIKE','%'.$report_handling->arho.'%')
                          ->get();

            $customer_obj->warna_customer = $query_arho[0]->warna_arho;

            $query_kelurahan = DB::table('kelurahan')
                               ->where('kelurahan.nama_kelurahan','LIKE','%'.$report_handling->kelurahan.'%')
                               ->where('kelurahan.is_aktif','=',1)
                               ->get();

            $customer_obj->nama_kelurahan = $query_kelurahan[0]->nama_kelurahan;

            $customer_obj->lat = $query_kelurahan[0]->lat;

            $customer_obj->lng = $query_kelurahan[0]->lng;

            array_push($markers_customer, $customer_obj);

            // if($query_arho->count()){
            //     $que
            // }
        }

        return response()->json($markers_customer);

        

    }
}
