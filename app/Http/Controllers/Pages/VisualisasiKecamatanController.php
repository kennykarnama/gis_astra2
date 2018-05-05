<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\AnalisisData\MyAnalisis;
use App\AnalisisData\AnalisisLaporan;
use App\Models\Kecamatan;

class VisualisasiKecamatanController extends Controller
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

    	return view('pages.visualisasi_kecamatan');
    }

    public function detail_kecamatan($id_kecamatan)
    {
    	# code...

      $analisis_laporan = new AnalisisLaporan ('test');

      $kecamatan = Kecamatan::find($id_kecamatan);

    	$laporan_saldo_handling_kecamatan = $analisis_laporan->hitung_laporan_saldo_handling_osa_kecamatan($kecamatan);

      //dd($kecamatan);
    	//$list_laporan = $this->get_laporan_arho2($kecamatan);

    	//dd($list_laporan);

    	return view('pages.detail_kecamatan',['kecamatan'=>$kecamatan,
        'laporan_saldo_handling_kecamatan'=>$laporan_saldo_handling_kecamatan]);
    }

    public function get_list_kecamatan(Request $request)
    {
    	# code...
    	$list_kecamatan = MyAnalisis::fetch_kecamatan();

    	$list_kecamatan_xls = MyAnalisis::fetch_kecamatan_from_xls();

    	$final_list_kecamatan = array();


    	foreach ($list_kecamatan_xls as $kecamatan_xls) {
    		# code...
    		$value_kecamatan = MyAnalisis::select_kecamatan_xls_db($kecamatan_xls,$list_kecamatan);

    		if(!is_null($value_kecamatan)){
    			array_push($final_list_kecamatan, $value_kecamatan);
    		}

    		
    		
    	}

    	return response()->json($final_list_kecamatan);
    }

      private function get_laporan_arho2($id_kecamatan)
    {
    	# code...

    	// get list kecamatan dulu

    	$xls_kecamatan = MyAnalisis::fetch_kecamatan_from_xls();

        $list_kecamatan = MyAnalisis::fetch_kecamatan();

        $final_list_kecamatan = array();

        foreach ($xls_kecamatan as $xls) {
            # code...

            foreach ($list_kecamatan as $kecamatan) {
                # code...
                // $str = strtoupper($kecamatan->nama_kecamatan);



                if($xls->KECAMATAN == $kecamatan->nama_kecamatan){
                    array_push($final_list_kecamatan, $kecamatan);
                }
            }
        }

        // get list arho 

        $xls_arho = MyAnalisis::fetch_arho_xls();

        $list_arho = MyAnalisis::fetch_arho();

        $final_list_arho = array();

        foreach ($xls_arho as $xls) {
        	# code...
        	foreach ($list_arho as $arho) {
        		# code...
        		if($xls->ARHO == $arho->nama_lengkap){
        			array_push($final_list_arho, $arho);
        		}
        	}
        }

        // get list penugasannya

        $list_penugasan = array();

      	foreach ($final_list_arho as $arho) {
      		# code...
      		$list_kecamatan_by_arho = MyAnalisis::fetch_kecamatan_by_arho($arho->nama_lengkap);

      		$nested = array();

      		$nested['arho'] = $arho;
      		$nested['kecamatan'] = array();

      		foreach ($list_kecamatan_by_arho as $kecamatan) {
      			# code...
      			$value_kecamatan = MyAnalisis::select_kecamatan_xls_db($kecamatan,$list_kecamatan);

      			if(!is_null($value_kecamatan)&&$value_kecamatan->id_kecamatan == $id_kecamatan){
      				array_push($nested['kecamatan'], $value_kecamatan);
      			}
      			
      		}

      		if(count($nested['kecamatan'])>0){
      			array_push($list_penugasan, $nested);
      		}

      		
      	}

      	// get laporan per arhonya, 

      	for($i = 0; $i < count($list_penugasan); $i++){
      		
      		$penugasan = $list_penugasan[$i];

      		$list_penugasan_kecamatan = $penugasan['kecamatan'];

      		$arho = $penugasan['arho'];

           $target = MyAnalisis::fetch_target_arho_by_nama_lengkap($arho->nama_lengkap);

      		for($j = 0; $j < count($list_penugasan_kecamatan); $j++){
      			$nama_kecamatan = $list_penugasan_kecamatan[$j]->nama_kecamatan;


            $jumlah_saldo = MyAnalisis::hitung_jumlah_saldo($arho->nama_lengkap,$nama_kecamatan);


            $jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal($arho->nama_lengkap,$nama_kecamatan,7);

            $jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal($arho->nama_lengkap,$nama_kecamatan,30);

            $persen_bal7 = 0;

            $persen_bal30 = 0;

            if($jumlah_saldo > 0){
                    $persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

                        $persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
            }

            $tmp = array(
               
                'jumlah_saldo'=>$jumlah_saldo,
                'bal7'=>$jumlah_saldo_bal_7,
                'persen_bal7'=>$persen_bal7,
                'bal30'=>$jumlah_saldo_bal_30,
                'persen_bal30'=>$persen_bal30,
                'target_arho'=>$target[0]->besar_target
                );

            if(MyAnalisis::is_valid_wilayah($jumlah_saldo)){
               $list_penugasan_kecamatan[$j]->LAPORAN = $tmp;
            }

      	}

      }

      	// foreach ($list_penugasan_kecamatan as $penugasan_kecamatan) {
      	// 		# code...

           

      	// 	}
      	//  }




        return $list_penugasan;
        //return response()->json($final_list_kecamatan);
    }
}
