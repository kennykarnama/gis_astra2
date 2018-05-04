<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\AnalisisData\AnalisisLaporan;


class InterfaceController extends Controller
{
    //

    public function __construct()
    {
        # code...
        $this->middleware('auth:admin');
    }
    public function test_login()
    {
    	# code...
    	return view('pages.signin');
    }

    public function dashboard()
    {
        # code...
        $analisis_laporan = new AnalisisLaporan('report_handling');

        $summary_arho_dashboard = $analisis_laporan->hitung_laporan_summary_arho_berdasarkan_kecamatan();

        $jumlah_osa = $analisis_laporan->hitung_jumlah_osa();

        $jumlah_customer = $analisis_laporan->hitung_jumlah_customer();

        $jumlah_saldo_handling = $analisis_laporan->hitung_saldo_handling();

        return view('pages.dashboard',[
            'summary_arho_dashboard'=>$summary_arho_dashboard,
            'jumlah_osa'=>$jumlah_osa,
            "jumlah_customer"=>$jumlah_customer,
            "jumlah_saldo_handling"=>$jumlah_saldo_handling
            ]);

        //return $summary_arho_dashboard;
        //dd($summary_arho_dashboard);
    }

 
    public function summary_arho()
    {
        # code...
       $query = DB::table('report')
                     ->select(DB::raw('report.ARHO,report.KECAMATAN,count(*) as jumlah_account'))
                     ->groupBy('report.ARHO','report.KECAMATAN')
                     ->get();

       $final_query = array();



       foreach ($query as $item) {
           # code...
            $sum_a = new SummaryArho();

            $sum_a->arho = $item->ARHO;

            $is_exist = $this->isExist($sum_a->arho,$final_query);

            if($is_exist == 0 && !is_null($sum_a->arho)){
                array_push($final_query, $sum_a);
            }

            

       }

       for ($i=0; $i < count($final_query); $i++) { 
           # code...

            $sum_a = $final_query[$i];

            $list_informasi = array();

            foreach ($query as $item) {
                # code...

                $tmp = array();


                if($item->ARHO == $sum_a->arho){
                   
                    $tmp['wilayah'] = $item->KECAMATAN;



                    $luas_wilayah = DB::table('kecamatan')->where('kecamatan.nama_kecamatan','LIKE','%'.$item->KECAMATAN.'%')->get();

                    $tmp['jumlah_account'] = $item->jumlah_account;

                    $tmp['luas_wilayah'] = $luas_wilayah[0]->luas_wilayah_km2;

                    //$final_query[$i]->informasi = $tmp;

                    $item->ARHO = "";

                    array_push($list_informasi, $tmp);

                }
            }

            $final_query[$i]->informasi = $list_informasi;
       }

        return $final_query;
    }

    public function isExist($val,$arr)
    {
        # code...
        for($i=0; $i < count($arr); $i++){
            if($val == $arr[$i]->arho)
                return 1;
        }

        return 0;
    }
}
