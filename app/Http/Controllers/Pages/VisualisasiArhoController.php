<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AnalisisData\MyAnalisis;
use App\AnalisisData\AnalisisLaporan;
use DB;
use App\Models\Kecamatan;
use App\Models\Arho;

/**
* 
*/
class ArhoObj
{
  
  
}

class KecamatanObj{

}

class VisualisasiArhoController extends Controller
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
    	return view('pages.visualisasi_data_arho',[]);
    }

    public function detail_laporan($id_arho,$id_kecamatan)
    {
      # code...

      $analisis_laporan = new AnalisisLaporan('test');

      $arho = Arho::find($id_arho);

      $query_target_arho = DB::table('target_arho')
                          ->where('target_arho.id_arho','=',$arho->id_arho)
                          ->get();

      $kecamatan = Kecamatan::find($id_kecamatan);

      $total_saldo_handling =  $analisis_laporan->hitung_saldo_handling_arho_kecamatan($arho->nama_lengkap,$kecamatan->nama_kecamatan);

      $laporan_osa_arho_kecamatan = $analisis_laporan->hitung_jumlah_osa_arho_kecamatan($arho->nama_lengkap,$kecamatan);

      //dd($laporan_osa_arho_kecamatan);

      $target_actual = 0.0;

      if($total_saldo_handling > 0 && $laporan_osa_arho_kecamatan[0]->total_osa > 0){
        $target_actual = ($total_saldo_handling) / $laporan_osa_arho_kecamatan[0]->total_osa;
      }

      $status_target = '';

      if($target_actual > $query_target_arho[0]->besar_target){
        $status_target = '#FF0000';
      }

       return view('pages.detail_arho_kecamatan',['arho'=>$arho,"kecamatan"=>$kecamatan,
          'total_saldo_handling'=>$total_saldo_handling,
          'laporan_osa_arho_kecamatan'=>$laporan_osa_arho_kecamatan[0],
          'target_arho'=>$query_target_arho[0],
          'target_actual'=>$target_actual*100,
          'status_target'=>$status_target 
        ]);

    }



    // public function detail_laporan($arho,$kecamatan)
    // {
    //   # code...

    //   $arho_query = DB::table('arho')->where('arho.id_arho','=',$arho)->get();

    //     $target = MyAnalisis::fetch_target_arho_by_nama_lengkap($arho_query[0]->nama_lengkap);

    //   $kecamatan_query = DB::table('kecamatan')->where('kecamatan.id_kecamatan',$kecamatan)->get();

    //    // $kecamatan = $request['kecamatan'];

    //    //  $arho = $request['arho'];
        
    //     $list_kelurahan = MyAnalisis::fetch_kelurahan($kecamatan_query[0]->nama_kecamatan);

    //     //dd($list_kelurahan);

    //     $detail_laporan = array();

    //     foreach ($list_kelurahan as $kelurahan) {
    //         # code...

    //         $jumlah_saldo = MyAnalisis::hitung_jumlah_saldo_kelurahan($arho_query[0]->nama_lengkap,$kelurahan->KELURAHAN);


    //         $jumlah_saldo_bal_7 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho_query[0]->nama_lengkap,$kelurahan->KELURAHAN,7);

    //         $jumlah_saldo_bal_30 = MyAnalisis::hitung_jumlah_saldo_bal_kelurahan($arho_query[0]->nama_lengkap,$kelurahan->KELURAHAN,30);

    //         $persen_bal7 = 0;

    //         $persen_bal30 = 0;

    //         if($jumlah_saldo > 0){
    //                 $persen_bal7 = ($jumlah_saldo - $jumlah_saldo_bal_7) / ($jumlah_saldo);

    //                     $persen_bal30 = ($jumlah_saldo - $jumlah_saldo_bal_30) / ($jumlah_saldo);
    //         }

    //         $tmp = array(
    //             'nama_kelurahan'=>$kelurahan->KELURAHAN,
    //             'jumlah_saldo'=>$jumlah_saldo,
    //             'bal7'=>$jumlah_saldo_bal_7,
    //             'persen_bal7'=>$persen_bal7,
    //             'bal30'=>$jumlah_saldo_bal_30,
    //             'persen_bal30'=>$persen_bal30,
    //             'target_arho'=>$target[0]->besar_target
    //             );

    //         if(MyAnalisis::is_valid_wilayah($jumlah_saldo)){
    //            array_push($detail_laporan, $tmp);
    //         }

    //     }

    //     //dd($detail_laporan);


    //   return view('pages.detail_arho_kecamatan',['arho'=>$arho_query,"kecamatan"=>$kecamatan_query,
    //     'detail_laporan'=>$detail_laporan
    //     ]);
    // }

    public function fetch_markers()
    {
    	# code...
    	$laporan_arho = $this->hitung_laporan_arho();

      foreach ($laporan_arho as $laporan) {
        # code...
        $target_arho = MyAnalisis::fetch_target_arho_by_nama_lengkap($laporan->nama_arho);

        $laporan->target_arho = $target_arho;

        //dd($target_arho);

        $total_saldo_handling_keseluruhan = 0;

        $list_kecamatan = $laporan->kecamatan;

        foreach ($list_kecamatan as $kecamatan) {
          # code...
          $total_saldo_handling_keseluruhan = $total_saldo_handling_keseluruhan + $kecamatan->jumlah_saldo_handling;


        }

        if($total_saldo_handling_keseluruhan < $target_arho[0]->besar_target){
          $laporan->avatar =  'campfire-2.png';

        }

        else{
          $laporan->avatar = 'pirates.png';
        }



      }


    	return response()->json($laporan_arho);
    }

    public function get_laporan_arho()
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

      			array_push($nested['kecamatan'], $value_kecamatan);
      		}

      		array_push($list_penugasan, $nested);
      	}

      	// get laporan per arhonya, 

      	for($i = 0; $i < count($list_penugasan); $i++){
      		
      		$penugasan = $list_penugasan[$i];

      		$list_penugasan_kecamatan = $penugasan['kecamatan'];

      		$arho = $penugasan['arho'];

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
                'persen_bal30'=>$persen_bal30
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




        return response()->json($list_penugasan);
        //return response()->json($final_list_kecamatan);
    }

    public function hitung_laporan_arho(){

      $laporan_arho = array();

      $laporan = DB::table('report_handling')->whereNotNull('report_handling.ARHO')->get();

      // dapatkan list arho dulu berdasarkan file excelnya, yg ada di report, exclude null

      $list_arho = DB::table('report_handling')->select('report_handling.arho')->whereNotNull('report_handling.arho')->distinct()->get();


      //dd($list_arho);

      // untuk setiap arho, dapatkan kecamatannya



      foreach ($list_arho as $arho) {
        # code...

        $arho_obj = new ArhoObj;

        $arho_has_kecamatan = array();

          foreach ($laporan as $item) {
            # code...
             $is_exist = $this->isExistKecamatan($item->kecamatan,$arho_has_kecamatan);

             //echo $is_exist;

             if($is_exist == 0 && $item->arho == $arho->arho){

              $query_koordinat_kecamatan = DB::table('kecamatan')->where('kecamatan.nama_kecamatan','LIKE','%'.$item->kecamatan.'%')->get();

              // if($query_koordinat_kecamatan->count()){

                $kecamatan_obj = new KecamatanObj;
              $kecamatan_obj->id_kecamatan = $query_koordinat_kecamatan[0]->id_kecamatan;
              $kecamatan_obj->nama_kecamatan = $item->kecamatan;
              $kecamatan_obj->lat = $query_koordinat_kecamatan[0]->lat;
              $kecamatan_obj->lng = $query_koordinat_kecamatan[0]->lng;
              array_push($arho_has_kecamatan, $kecamatan_obj);

              // }

              // else{
              //   dd($item->kecamatan);
              // }

              
             }
          }

          $query_arho = DB::table('arho')->where('arho.nama_lengkap','LIKE','%'.$arho->arho.'%')->get();


          // if($query_arho->count()){

             $arho_obj->id_arho = $query_arho[0]->id_arho;

          $arho_obj->warna_arho = $query_arho[0]->warna_arho;

          $arho_obj->nama_arho = $arho->arho;

          $arho_obj->kecamatan = $arho_has_kecamatan;

          array_push($laporan_arho, $arho_obj);

          // }


         
      }



      // setelah itu dapatkan jumlah saldo nya berdasarkan kecamatannya

      foreach ($laporan_arho as $item_arho) {
        # code...

        // untuk arho skrng, dapatkan list kecamatannya

        $arho_has_kecamatan = $item_arho->kecamatan;

        // iterasi, lalu hitung berdasarkann parameter, nama arho, nama kecamatan
        // hitung jumlah saldo, bal7, bal30

        foreach ($arho_has_kecamatan as $item_kecamatan) {
          # code...
          $nama_kecamatan = $item_kecamatan->nama_kecamatan;

          $nama_arho = $item_arho->nama_arho;

            $jumlah_saldo_handling = MyAnalisis::hitung_jumlah_saldo_handling($nama_arho,$nama_kecamatan);

            $item_kecamatan->jumlah_saldo_handling = $jumlah_saldo_handling;

           



        }

      }

     


      //dd($laporan_arho);

      return $laporan_arho;




    }

     private function get_laporan_arho2()
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

      			array_push($nested['kecamatan'], $value_kecamatan);
      		}

      		array_push($list_penugasan, $nested);
      	}

      	// get laporan per arhonya, 

      	for($i = 0; $i < count($list_penugasan); $i++){
      		
      		$penugasan = $list_penugasan[$i];

      		$list_penugasan_kecamatan = $penugasan['kecamatan'];

      		$arho = $penugasan['arho'];

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
                'persen_bal30'=>$persen_bal30
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

    private function isExistKecamatan($kecamatan_value,$list_kecamatan){
      foreach ($list_kecamatan as $kecamatan) {
        # code...
        if(isset($kecamatan->nama_kecamatan) && strtolower($kecamatan_value) == strtolower($kecamatan->nama_kecamatan))
          return 1;
      }
      return 0;
    }
}
