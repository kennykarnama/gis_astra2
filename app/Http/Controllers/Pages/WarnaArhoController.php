<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\AnalisisData\MyAnalisis;

class WarnaArhoController extends Controller
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
    	$list_arho = MyAnalisis::fetch_arho();

    	return view('pages.warna_arho',['list_arho'=>$list_arho]);
    }

    public function update_warna_arho(Request $request)
    {
    	# code...
    	$id_arho = $request['id_arho'];

    	$warna_arho = $request['warna_arho'];

    	$status_update = DB::table('arho')
    					->where('arho.id_arho','=',$id_arho)
    					->update(['arho.warna_arho'=>$warna_arho]);

    	if($status_update){
    		return 1;
    	}
    	else{
    		return 0;
    	}
    }


}
