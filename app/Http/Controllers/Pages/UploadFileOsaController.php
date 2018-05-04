<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Events\ImportLaporanEvent;
use Illuminate\Support\Facades\Input;
use Excel;
use Carbon\Carbon;


class UploadFileOsaController extends Controller
{
    //

    private $nama_tabel;

    private $upload_time;

    public function __construct()
    {
    	# code...
    	$this->middleware('auth:admin');

    	$this->nama_tabel = "osa_acc_kelurahan";

    	$this->upload_time = Carbon::now('Asia/Jakarta');

    }

    public function index()
    {
    	# code...
    	return view('pages.upload_file_osa',[]);
    }

    public function import_excel(Request $request)
    {
    	# code...
    	 $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $upload_success =  Input::file('file')->move($this->nama_tabel,$file_name);

        if($upload_success){

        	

            $path = public_path()."/".$this->nama_tabel."/".$file_name;

    	  DB::table($this->nama_tabel)->truncate();

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

                            $tmp['is_deleted'] = 0;

                            $tmp['upload_time'] = $this->upload_time;

                            //dd($tmp);

                            if($is_not_null == 1){

                            	 array_push($prepared_data, $tmp);

                            }

                           

                        }

                       DB::table($this->nama_tabel)->insert($prepared_data);


        




                },false);

             
         event(new ImportLaporanEvent("Data telah diimport"));

         return response('sukses',200);

     }

      else{
            return response('gagal',400);
        }
    }
}