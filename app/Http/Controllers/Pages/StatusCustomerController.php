<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\AnalisisData\MyAnalisis;
use DB;

class StatusCustomerController extends Controller
{
    //
    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');

    	ini_set('memory_limit', '-1');
    }

    public function allCustomers(Request $request)
    {
    	# code...
    	$columns = array(
    		2=>"Saldo",
    		3=>"SALDO2",
    		4=>"ARHO",
    		5=>"KECAMATAN",
    		6=>"KELURAHAN"

    		);

    	$totalData = MyAnalisis::hitung_reports();

    	$totalFiltered = $totalData;

    	$limit = $request->input('length');
        $start = $request->input('start');
       
       if(($request->input('order.0.column'))!==NULL){
              $order = $columns[$request->input('order.0.column')];
              
              $dir = $request->input('order.0.dir');

        }

        if(empty($request->input('search.value'))){

        	if(isset($order)&&isset($dir)){
        		$customers = $this->fetch_reports_ordered($start,$limit,$order,$dir);
        	}

        	else{
        		$customers = $this->fetch_reports($start,$limit);
        	}
        }

        else{

        	$search_value = $request->input('search.value');

        	if(isset($order)&&isset($dir)){
        		$customers = $this->fetch_reports_filtered_ordered($start,$limit,$search_value,$order,$dir);
        	}

        	else{
        		$customers = $this->fetch_reports_filtered($start,$limit,$search_value);
        	}

        	$totalFiltered = count($customers);

        }

        $data = array();

        $puter = $start+1;

        if(!empty($customers)){
        	foreach ($customers as $customer) {
        		# code...
        		$nested['no'] = $puter++;

        		$nested['agreement'] = $customer->Agreement;

        		$nested['arho'] = $customer->ARHO;

        		$nested['saldo'] = $customer->Saldo;

        		$nested['saldo2'] = $customer->SALDO2;

        		$nested['kecamatan'] = $customer->KECAMATAN;

        		$nested['kelurahan'] = $customer->KELURAHAN;

        		$nested['actions'] = '<button type="button" class="btn bg-blue waves-effect">Ubah Status</button>';

        		array_push($data, $nested);

        	}
        }

         $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }


    public function fetch_reports($start,$limit)
    {
    	# code...
    	$query = DB::table('report_rev')
    			->whereNotNull('report_rev.KECAMATAN')
    			->offset($start)
    			->limit($limit)
    			->get();

    	return $query;
    }

    public function fetch_reports_ordered($start,$limit,$order,$dir)
    {
    	# code...
    	$query = DB::table('report_rev')
    			->whereNotNull('report_rev.KECAMATAN')
    			->offset($start)
    			->limit($limit)
    			->orderBy($order,$dir)
    			->get();

    	return $query;
    }

    public function fetch_reports_filtered($start,$limit,$search_value)
    {
    	# code...
    	$query = DB::table('report_rev')
    			->offset($start)
    			->limit($limit)
    			->where('report_rev.Agreement','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.ARHO','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.KECAMATAN','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.KELURAHAN','LIKE',"%{$search_value}%")
    			->get();

    	$final_query = array();

    	foreach ($query as $item) {
    		# code...
    		if(!is_null($item)){
    			array_push($final_query, $item);
    		}
    	}

    	return $final_query;
    }

    public function fetch_reports_filtered_ordered($start,$limit,$search_value,$order,$dir)
    {
    	# code...
    	$query = DB::table('report_rev')
    			->offset($start)
    			->limit($limit)
    			->where('report_rev.Agreement','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.ARHO','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.KECAMATAN','LIKE',"%{$search_value}%")
    			->orWhere('report_rev.KELURAHAN','LIKE',"%{$search_value}%")
    			->orderBy($order,$dir)
    			->get();

    	$final_query = array();

    	foreach ($query as $item) {
    		# code...
    		if(!is_null($item)){
    			array_push($final_query, $item);
    		}
    	}

    	return $final_query;
    }


    public function index()
    {
    	# code...
    	$customers = MyAnalisis::fetch_reports();

    	return view('pages.status_customer',[
    		'customers'=>$customers
    		]);
    }
}
