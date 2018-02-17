<?php

namespace App\AnalisisData;

use App\AnalisisData\Kelurahan;

class Kecamatan {

	public $id_kecamatan;

	public $nama_kecamatan;

	public $latitude;

	public $longitude;

	public $arr_kelurahan;

	public function __construct()
	{
		# code...

		$arr_kelurahan = array();
	}

	public function set_id_kecamatan($id_kecamatan)
	{
		# code...
		$this->id_kecamatan = $id_kecamatan;
	}

	public function set_nama_kecamatan($nama_kecamatan)
	{
		# code...
		$this->nama_kecamatan = $nama_kecamatan;
	}

	public function set_latitude($latitude)
	{
		# code...
		$this->latitude = $latitude;
	}

	public function set_longitude($longitude)
	{
		# code...
		$this->longitude = $longitude;
	}

	public function insert_kelurahan(Kelurahan $kelurahan)
	{
		# code...
		array_push($this->kelurahan, $kelurahan);
	}

	public function get_id_kecamatan()
	{
		# code...
		return $this->id_kecamatan;
	}

	public function get_nama_kecamatan()
	{
		# code...
		return $this->nama_kecamatan;
	}

	public function get_latitude()
	{
		# code...
		return $this->latitude;
	}

	public function get_longitude()
	{
		# code...
		return $this->longitude;
	}

	public function fetch_kelurahan()
	{
		# code...
		return $this->kelurahan;
	}
}