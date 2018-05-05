<?php

namespace App\AnalisisData;


use DB;

/**
* 
*/

/**
* Helper class 
*/
class Kecamatan 
{
	
	
}

/**
* 
*/
class Kelurahan 
{
	

}

/**
* 
*/
class Arho  
{
	
	
}

/**
* 
*/
class LaporanSaldoHandlingKecamatan 
{
	
	function __construct()
	{
		# code...
	}
}


class AnalisisLaporan
{

	private $nama_tabel;

	function __construct($nama_tabel)
	{
		# code...
		$this->nama_tabel = $nama_tabel;
	}

	public function hitung_laporan_saldo_handling_osa_kecamatan($kecamatan)
	{
		# code...
		
		$query_data = DB::table('report_handling')
					  ->where('report_handling.kecamatan','LIKE','%'.$kecamatan->nama_kecamatan.'%')
					  ->where('report_handling.status_report_handling','=',1)
					  ->get();

		$has_kelurahan = array();

		foreach ($query_data as $item) {
			# code...
			$query_arho = DB::table('arho')
						  ->where('arho.nama_lengkap','LIKE','%'.$item->arho.'%')
						  ->get();

			$query_kelurahan = DB::table('kelurahan')
							   ->where('kelurahan.nama_kelurahan','LIKE','%'.$item->kelurahan.'%')
							   ->get();

			$query_osa_acc = DB::table('osa_acc_kelurahan')
							->where('osa_acc_kelurahan.kelurahan','LIKE','%'.$item->kelurahan.'%')
							->where('osa_acc_kelurahan.arho','LIKE','%'.$item->arho.'%')
							->where('osa_acc_kelurahan.is_deleted','=',0)
							->get();


			if($query_arho->count() && $query_kelurahan->count() && $query_osa_acc->count()){
				$kelurahan_obj = new Kelurahan;

				$kelurahan_obj->nama_kelurahan = $item->kelurahan;

				$kelurahan_obj->id_kelurahan = $query_kelurahan[0]->id_kelurahan;

				$kelurahan_obj->saldo = $item->saldo;

				$kelurahan_obj->nama_arho = $item->arho;

				$kelurahan_obj->id_arho = $query_arho[0]->id_arho;

				$kelurahan_obj->agreement = $item->agreement;

				$kelurahan_obj->nama_cust = $item->nama_cust;

				$kelurahan_obj->osa = $query_osa_acc[0]->osa;

				array_push($has_kelurahan, $kelurahan_obj);

			}
		}



		$laporan_saldo_handling_kecamatan = new LaporanSaldoHandlingKecamatan;

		$laporan_saldo_handling_kecamatan->kecamatan = $kecamatan;

		$laporan_saldo_handling_kecamatan->has_kelurahan = $has_kelurahan;

		return $laporan_saldo_handling_kecamatan;




	}

	public function hitung_saldo_handling_arho_kecamatan($nama_arho,$nama_kecamatan)
	{
		# code...
		$total_saldo_handling = DB::table('report_handling')
								->where('report_handling.arho','LIKE','%'.$nama_arho.'%')
								->where('report_handling.kecamatan','LIKE','%'.$nama_kecamatan.'%')
								->where('report_handling.status_report_handling','=',1)
								->sum('report_handling.saldo');

		return $total_saldo_handling;
	}

	public function hitung_jumlah_osa_arho_kecamatan($nama_arho,$kecamatan)
	{
		# code...

		$summary_arho_berdasarkan_kecamatan = $this->hitung_laporan_summary_arho_berdasarkan_kecamatan();

		$laporan_osa_arho_kecamatan = array();

		$total_osa = 0;

		foreach ($summary_arho_berdasarkan_kecamatan as $arho_berdasarkan_kecamatan) {


			# code...

			if($arho_berdasarkan_kecamatan->nama_arho == $nama_arho){

				$has_kelurahan = $arho_berdasarkan_kecamatan->has_kelurahan;



				foreach ($has_kelurahan as $kelurahan) {
					# code...
					if($kelurahan->id_kecamatan == $kecamatan->id_kecamatan){
						$total_osa = $total_osa + $kelurahan->osa;
					}
				}

				$arho_obj = new Arho;

				$arho_obj->nama_arho = $nama_arho;

				$arho_obj->nama_kecamatan = $kecamatan->nama_kecamatan;

				$arho_obj->total_osa = $total_osa;

				array_push($laporan_osa_arho_kecamatan, $arho_obj);	
			}
			
		}

		return $laporan_osa_arho_kecamatan;


	}

	public function hitung_jumlah_account_arho($nama_arho)
	{
		# code...
		$jumlah_account = DB::table($this->nama_tabel)
						  ->whereNotNull($nama_tabel.".".'arho')
						  ->where($nama_tabel.".".'arho','=',$nama_arho)
						  ->sum($nama_tabel.'.'.'acc');

		return $jumlah_account;
	}

	public function hitung_jumlah_account_arho_kecamatan($nama_arho,$nama_kecamatan)
	{
		# code...
		$query_data_osa_acc = DB::table('osa_acc_kelurahan')
							  ->where('osa_acc_kelurahan.is_deleted','=',0)
							  ->where('osa_acc_kelurahan.arho','LIKE','%'.$nama_arho.'%')
							  ->get();

		$total_acc = 0;

		foreach ($query_data_osa_acc as $data_osa_acc) {
			# code...
			$query_kecamatan = DB::table('kelurahan')
							   ->join('kecamatan','kecamatan.id_kecamatan','=','kelurahan.id_kecamatan')
							   ->where('kelurahan.nama_kelurahan','LIKE','%'.$data_osa_acc->kelurahan.'%')
							   ->get();

			// if($query_kecamatan->count()){

			if(stripos($query_kecamatan[0]->nama_kecamatan, $nama_kecamatan) !== FALSE){
				$total_acc+=$data_osa_acc->acc;
			}
				
			// }
			


		}

		return $total_acc;
	}

	public function hitung_jumlah_customer()
	{
		# code...
		$jumlah_osa = DB::table('osa_acc_kelurahan')
					  ->where('osa_acc_kelurahan.is_deleted','=',0)
					  ->sum('osa_acc_kelurahan.acc');

		return $jumlah_osa;

	}

	public function hitung_jumlah_osa()
	{
		# code...
		$jumlah_osa = DB::table('osa_acc_kelurahan')
					  ->where('osa_acc_kelurahan.is_deleted','=',0)
					  ->sum('osa_acc_kelurahan.osa');

		return $jumlah_osa;
	}

	public function hitung_saldo_handling()
	{
		# code...
		$jumlah_handling = DB::table('report_handling')
							->where('report_handling.status_report_handling','=',1)
							->sum('report_handling.saldo');

		return $jumlah_handling;
	}

	public function hitung_laporan_summary_arho_berdasarkan_kecamatan()
	{
		# code...

		$list_kelurahan = DB::table('kelurahan')->where('kelurahan.is_aktif','=',1)
						 ->get();

		$list_kecamatan = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

		$pohon_kecamatan = array();

		foreach ($list_kecamatan as $kecamatan_item) {
			# code...

			$kecamatan = new Kecamatan;

			$kecamatan->id_kecamatan = $kecamatan_item->id_kecamatan;

			$kecamatan->nama_kecamatan = $kecamatan_item->nama_kecamatan;

			$kecamatan->luas_wilayah = $kecamatan_item->luas_wilayah_km2;

			$pohon_kelurahan = array();

			foreach ($list_kelurahan as $kelurahan_item) {
				# code...
				if($kelurahan_item->id_kecamatan == $kecamatan_item->id_kecamatan){
					$kelurahan = new Kelurahan;

					$kelurahan->id_kelurahan = $kelurahan_item->id_kelurahan;

					$kelurahan->nama_kelurahan = $kelurahan_item->nama_kelurahan;

					array_push($pohon_kelurahan, $kelurahan);
				}
			}

			$kecamatan->has_kelurahan = $pohon_kelurahan;

			array_push($pohon_kecamatan, $kecamatan);

			//array_push($hitung_laporan_summary_arho_berdasarkan_kecamatan, $kecamatan);
		}

		//dd($pohon_kecamatan);

		$laporan_arho = array();



		$query_arho = DB::table('osa_acc_kelurahan')
								->select('osa_acc_kelurahan.arho')
								//->where('osa_acc_kelurahan.is_deleted','=',0)
								->distinct()
								->get();



		foreach ($query_arho as $arho) {
			# code...
			$arho_obj = new Arho;

			$arho_obj->nama_arho = $arho->arho;

			array_push($laporan_arho, $arho_obj);
		}

		$query_arho_kelurahan = DB::table('osa_acc_kelurahan')
								->get();


		


		foreach ($laporan_arho as $arho) {

			# code...

			$arho_obj = new Arho;


			$query_data = DB::table('kelurahan')
							   ->join('osa_acc_kelurahan','osa_acc_kelurahan.kelurahan','=','kelurahan.nama_kelurahan')
							   ->where('kelurahan.is_aktif','=',1)
							   ->where('osa_acc_kelurahan.arho','LIKE','%'.$arho->nama_arho.'%')
							  
							   ->get();

			$has_kelurahan = array();

			foreach ($query_data as $item) {
				# code...
				//$arho->kelurahan = $item->nama_kelurahan;

				$kelurahan_obj = new Kelurahan;

				$kelurahan_obj->nama_kelurahan = $item->nama_kelurahan;

				$kelurahan_obj->acc = $item->acc;

				$kelurahan_obj->osa = $item->osa;

				$query_data_kecamatan = DB::table('kecamatan')
										->where('kecamatan.id_kecamatan','=',$item->id_kecamatan)
										->get();

				if($query_data_kecamatan->count()){
				$kelurahan_obj->nama_kecamatan = $query_data_kecamatan[0]->nama_kecamatan;

				$kelurahan_obj->luas_wilayah = $query_data_kecamatan[0]->luas_wilayah_km2;

				$kelurahan_obj->id_kecamatan = $query_data_kecamatan[0]->id_kecamatan;

				if($this->isExistKelurahan($item->nama_kelurahan,$has_kelurahan)==-1){
					array_push($has_kelurahan, $kelurahan_obj);	
				}

					
				}

				
			}

			$arho->has_kelurahan = $has_kelurahan;

		}


		// foreach ($query_arho_kelurahan as $arho_kelurahan) {
		// 	# code...
		// }

		// dd($laporan_arho);

		return $laporan_arho;

	}

	private function get_kelurahan_kecamatan($nama_kecamatan){
		$query = DB::table('kelurahan')
				 ->join('kecamatan','kelurahan.id_kecamatan','=','kecamatan.id_kecamatan')
				 ->where('kecamatan.nama_kecamatan','LIKE','%'.$nama_kecamatan.'%')
				 ->get();

		return $query;
	}

	private function isExistKecamatan($nama_kecamatan,$data_kecamatan){

		for($i=0; $i < count($data_kecamatan); $i++){
			if(isset($data_kecamatan[$i]->nama_kecamatan) && 
				$data_kecamatan[$i]->nama_kecamatan == $nama_kecamatan)
				return $i;
		}

		return -1;
	}

	private function isExistKelurahan($nama_kelurahan,$data_kelurahan){
		for($i=0; $i < count($data_kelurahan); $i++){
			if(isset($data_kelurahan[$i]->nama_kelurahan) && 
				$data_kelurahan[$i]->nama_kelurahan == $nama_kelurahan)
				return $i;
		}

		return -1;
	}


	private function isExistArho($nama_arho,$data_arho){
		
		for($i=0; $i < count($data_arho); $i++){
			if(isset($data_arho[$i]->nama_arho) && 
				$data_arho[$i]->nama_arho == $nama_arho)
				return $i;
		}

		return -1;
	}
}