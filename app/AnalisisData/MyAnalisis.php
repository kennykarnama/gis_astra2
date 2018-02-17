<?php

namespace App\AnalisisData;


use DB;

use App\AnalisisData\Kecamatan;

use App\AnalisisData\Kelurahan;

use App\AnalisisData\Arho;

class MyAnalisis {

	
	public static function fetch_target_arho()
	{
		# code...
		$query = DB::table('target_arho')
					 ->join('arho','target_arho.id_arho','=','arho.id_arho')
					 ->where('arho.is_aktif','=',1)
					
					->get();

		return $query;

	}

	public static function fetch_reports()
	{
		# code...
		$query = DB::table('report_rev')->whereNotNull('report_rev.KECAMATAN')->get();

		return $query;
	}

	public static function hitung_reports()
	{
		# code...
		$query = DB::table('report_rev')->whereNotNull('report_rev.KECAMATAN')->count();

		return $query;
	}

	public static function fetch_arho(){
		
		$query = DB::table('arho')->where('arho.is_aktif','=',1)->get();

		return $query;
	}

	public static function fetch_object_arho()
	{
		# code...
		$list_arho_xls = DB::table('report_rev')->select('report_rev.ARHO')->distinct()
							->get();

		$list_arho = DB::table('arho')->where('arho.is_aktif','=',1)->get();

		$arr_obj_arho = array();

		foreach ($list_arho_xls as $arho_xls) {
			# code...

			foreach ($list_arho as $arho) {
				# code...
				if($arho_xls->ARHO == $arho->nama_lengkap){
					
					$class_arho = new Arho;

					$class_arho->set_id_arho($arho->id_arho);

					$class_arho->set_nama_arho($arho->nama_lengkap);

					array_push($arr_obj_arho, $class_arho);
				}
			}
			
		}

		return $arr_obj_arho;
	}

	public static function fetch_object_kecamatan()
	{
		# code...
		$list_kecamatan_xls = DB::table('report_rev')->select('report_rev.KECAMATAN')->distinct()
					 ->get();

		$list_kecamatan = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

		$arr_obj_kecamatan = array();

		foreach ($list_kecamatan_xls as $kecamatan_xls) {
			# code...
			foreach ($list_kecamatan as $kecamatan) {
				# code...
				if($kecamatan_xls->KECAMATAN == $kecamatan->nama_kecamatan){
					
					$class_kecamatan = new Kecamatan;

					$class_kecamatan->set_id_kecamatan($kecamatan->id_kecamatan);

					$class_kecamatan->set_nama_kecamatan($kecamatan->nama_kecamatan);

					$class_kecamatan->set_latitude($kecamatan->lat);

					$class_kecamatan->set_longitude($kecamatan->lng);



					array_push($arr_obj_kecamatan, $class_kecamatan);

					break;

				}

			}
		}


		return $arr_obj_kecamatan;
	}

	public function fetch_arho_markers($icon)
	{
		# code...

		
		// select distinct arho

		// foreach arho

			// find same name arho, 
				// find kelurahan in table kecamatan, get coordinate
				// create object (make class Kelurahan)
				// assign attribute lang, lat, and icon based on target (rand)
			// push to array
		// create class Arho, assign nama_arho and kecamatan 

		// return
	}

	public static function fetch_customer_markers($icon)
	{
		# code...
		$query = DB::table('report_rev')->whereNotNull('report_rev.ARHO')->get();

		$final_query = array();

		foreach ($query as $customer) {
			# code...
			$status_customer = $customer->status_customer;

			$nested = array();

			$nested['no_agreement'] = $customer->Agreement;

			$nested['alamat'] = $customer->Alamat;

			$nested['kode_pos'] =$customer->Kd_Pos;

			$nested['kecamatan'] = $customer->KECAMATAN;

			$nested['kelurahan'] = $customer->KELURAHAN;

			$nested['tgl_due'] = $customer->Tgl_Due;

			$nested['saldo'] = $customer->Saldo;

			$nested['latitude']  = $customer->latitude;

			$nested['longitude'] = $customer->longitude;

			$nested['arho'] = $customer->ARHO;

			$nested['icon'] = $icon[$status_customer];

			array_push($final_query, $nested);
		}

		return $final_query;
	}

	// dummy function

	public static function tentukan_target_arho()
	{
		# code...
		return rand(0,1);
	}

	public static function get_place_id($kecamatan)
	{
		# code...
		$query = DB::table('kecamatan')->select('kecamatan.place_id')
										->where('kecamatan.nama_kecamatan','=',$kecamatan)
										->get();

		return $query;
	}

	public static function fetch_arho_by_kecamatan($kecamatan)
	{
		# code...
		$query = DB::table('report')->select('report.ARHO')->distinct()
									->where('report.KECAMATAN','=',$kecamatan)->get();

		return $query;
	}

	public static function fetch_kecamatan(){
		$query = DB::table('kecamatan')->where('kecamatan.is_aktif','=',1)->get();

		return $query;
	}

	public static function fetch_kecamatan_by_arho($arho)
	{
		# code...
		$query = DB::table('report')->select('report.KECAMATAN')->distinct()
									->where('report.ARHO','=',$arho)->get();

		return $query;
	}

	public static function fetch_kecamatan_from_xls()
	{
		# code...
		$query = DB::table('report')->select('report.KECAMATAN')->distinct()
					 ->get();

		return $query;
	}

	

	public static function fetch_kelurahan($kecamatan)
	{
		# code...
		$query = DB::table('report')->select('report.KELURAHAN')->distinct()
						   ->where('report.KECAMATAN','=',$kecamatan)
						    ->get();
		
		return $query;
	}

	public static function hitung_jumlah_saldo($arho,$kecamatan)
	{
		# code...

		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KECAMATAN','=',$kecamatan)
											->sum('report.SALDO2');

		return $jumlah_saldo;

	}

	public static function hitung_jumlah_saldo_kelurahan($arho,$kelurahan)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KELURAHAN','=',$kelurahan)
											->sum('report.SALDO2');

		return $jumlah_saldo;
	}

	public static function hitung_jumlah_saldo_bal($arho,$kecamatan,$bal)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KECAMATAN','=',$kecamatan)
											->where('report.EOD','<=',$bal)
											->sum('report.SALDO2');

		return $jumlah_saldo;

	}

	public static function hitung_jumlah_saldo_bal_kelurahan($arho,$kelurahan,$bal)
	{
		# code...
		$jumlah_saldo = DB::table('report')->where('report.ARHO','=',$arho)
											->where('report.KELURAHAN','=',$kelurahan)
											->where('report.EOD','<=',$bal)
											->sum('report.SALDO2');

		return $jumlah_saldo;
	}

	public static function is_valid_wilayah($jumlah_saldo){
		return $jumlah_saldo > 0;
	}

}