<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Jobs\ImportFileHandlingArhoJob;
use App\Events\ImportLaporanEvent;
use Illuminate\Support\Facades\Input;
use Excel;

class ImportLaporanHandlingController extends Controller
{
    //
    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');
    }

    public function index()
    {
    	# code...
    	return view('pages.upload_laporan_handling',[]);
    }

    public function import_excel()
    {
    	# code...

    	 $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $upload_success =  Input::file('file')->move('laporan_handling',$file_name);

        if($upload_success){
           

            $path = public_path()."/laporan_handling/".$file_name;

    	  DB::table('report_handling')->truncate();

        Excel::filter('chunk')->load($path)->chunk(250, function($results)
                {
                    

                    $prepared_data = array();

                    foreach($results as $row)
                        {
                            $headers = $row->keys()->all();

                            //dd($headers);

                            $tmp = array();

                            $is_not_null = 1;

                            for($i = 0; $i < count($headers); $i++){
                                
                                $col_name = $headers[$i];

                                $tmp[$col_name] = $row[$col_name];

                                if(is_null($tmp[$col_name])){
                                	$is_not_null = 0;
                                	break;
                                }


                            }

                            $tmp['status_report_handling'] = 1;

                            //dd($tmp);

                            if($is_not_null == 1){

                            	 array_push($prepared_data, $tmp);

                            }

                           

                        }

                       DB::table('report_handling')->insert($prepared_data);


        




                },false);

             
         event(new ImportLaporanEvent("Data telah diimport"));

         return response('sukses',200);

     }

      else{
            return response('gagal',400);
        }

    }
}
