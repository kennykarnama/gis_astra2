<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Jobs\ImportToDbJob;
use App\Events\ImportLaporanEvent;

class ImportFileController extends Controller
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
    	return view('pages.upload_file_laporan');
    }

     public function import_excel()
    {
        # code...
        $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $upload_success =  Input::file('file')->move('file_laporan',$file_name);

        if($upload_success){
           

            $path = public_path()."/file_laporan/".$file_name;

            dispatch(new ImportToDbJob($path));

        
          
             return response('sukses',200);
        }

        else{
            return response('gagal',400);
        }

               
    }
}
