<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Jobs\ImportDataCustomerJob;
use App\Events\ImportLaporanEvent;
use Illuminate\Support\Facades\Input;
use Excel;

class ImportDataCustomerController extends Controller
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
    	return view('pages.import_data_customer',[]);
    }

        public function import_excel()
    {
        # code...
        $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $upload_success =  Input::file('file')->move('data_customer',$file_name);

        if($upload_success){
           

            $path = public_path()."/data_customer/".$file_name;



           

              event(new ImportLaporanEvent("Data sedang diimport"));

                $nama_sheet = array();


      $nama_sheet = Excel::load($path)->getSheetNames();

            for($i=0; $i<count($nama_sheet); $i++){

                //dd($nama_sheet[$i]);

                Excel::selectSheets($nama_sheet[$i])->load($path, function($reader) {

                    // Getting all results
                    $results = $reader->get();

                    $prepared_data = array();

                    foreach($results as $row)
                        {
                            $headers = $row->keys()->all();

                            //dd($headers);

                            $tmp = array();

                            $is_insert = 1;

                            for($i = 0; $i < count($headers); $i++){
                                
                                $col_name = $headers[$i];

                                $tmp[$col_name] = $row[$col_name];

                                if(is_null($tmp[$col_name])){
                                    $is_insert = 0;
                                    break;
                                }



                            }

                            $tmp['nama_sheet'] = $results->getTitle();

                            //dd($tmp);

                            if($is_insert == 1){

                                 array_push($prepared_data, $tmp);

                            }

                           

                        }

                        //echo "ya"."<br>";

                       DB::table('data_customer')->insert($prepared_data);

                });
            }

            event(new ImportLaporanEvent("Data telah diimport"));



             //dispatch(new ImportDataCustomerJob($path));

        
          
             return response('sukses',200);
        }

        else{
            return response('gagal',400);
        }

               
    }
}
