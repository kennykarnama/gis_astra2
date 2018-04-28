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

class ImportFileHandlingArhoController extends Controller
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
    	return view('pages.import_file_handling_arho',[]);
    }

        public function import_excel()
    {
        # code...
        $file = Input::file('file');

        $file_name = $file->getClientOriginalName();

        $upload_success =  Input::file('file')->move('file_handling_arho',$file_name);

        if($upload_success){
           

            $path = public_path()."/file_handling_arho/".$file_name;

             event(new ImportLaporanEvent("Data sedang diimport"));

            dispatch(new ImportFileHandlingArhoJob($path));

        
          
             return response('sukses',200);
        }

        else{
            return response('gagal',400);
        }

               
    }
}
