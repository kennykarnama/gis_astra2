<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use DB;
use Excel;
use App\Events\ImportLaporanEvent;

class ImportDataCustomerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $path;

    public $tries = 1;

    public $timeout = 0;

    public function __construct($path)
    {
        //
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

         ini_set('memory_limit', '-1');

          DB::table('data_customer')->truncate();
    
    // get list of sheets

    $nama_sheet = array();


      $nama_sheet = Excel::load($this->path)->getSheetNames();

            for($i=0; $i<count($nama_sheet); $i++){

                //dd($nama_sheet[$i]);

                Excel::selectSheets($nama_sheet[$i])->load($this->path, function($reader) {

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

    }
}
