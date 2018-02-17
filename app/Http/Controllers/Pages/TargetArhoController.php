<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AnalisisData\MyAnalisis;

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
        $list_target_arho = MyAnalisis::fetch_target_arho();


    	return view('pages.target_arho',[
            'list_target_arho'=>$list_target_arho
            ]);
        
    }
}
