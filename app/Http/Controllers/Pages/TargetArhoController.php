<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AnalisisData\MyAnalisis;
use DB;
use Auth;

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

    public function update_target_arho(Request $request)
    {
        # code...
        $id_target_arho = $request['id_target_arho'];

        $id_arho = $request['id_arho'];

        $besar_target = $request['besar_target'];

        $tgl_target = $request['tgl_target'];


                DB::beginTransaction();

        try {
            
            

         $status = DB::table('target_arho')->where('target_arho.id_target_arho','=',$id_target_arho)
                    ->where('target_arho.id_arho','=',$id_arho)
                    ->update(['besar_target'=>$besar_target,
                        'tgl_target'=>$tgl_target
                        ]);

        if($status){

             DB::table('target_arho')->where('target_arho.id_target_arho','=',$id_target_arho)
                    ->where('target_arho.id_arho','=',$id_arho)
                    ->update([

                        'is_deleted'=>1
                        ]);
            

           

        }
            


               


            DB::commit();

            return 1;
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return 0;
            // something went wrong
        }

       
       
    }
}
