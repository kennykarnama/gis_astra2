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


class AnalisisLaporan
{

	private $nama_tabel;

	function __construct($nama_tabel)
	{
		# code...
		$this->nama_tabel = $nama_tabel;
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