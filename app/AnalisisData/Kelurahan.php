<?php

namespace App\AnalisisData;

use App\AnalisisData\Kecamatan;

class Kelurahan {

	private $id_kelurahan;

	private $nama_kelurahan;

	private $latitude;

	private $longitude;

	private $kecamatan;

	public function __construct()
	{
		# code...

	}

	public function set_id_kelurahan($id_kelurahan)
	{
		# code...
		$this->id_kelurahan = $id_kelurahan;
	}

	public function set_nama_kelurahan($nama_kelurahan)
	{
		# code...
		$this->nama_kelurahan = $nama_kelurahan;
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

	public function set_kecamatan(Kecamatan $kecamatan)
	{
		# code...
		$this->kecamatan = $kecamatan;
	}

	public function get_id_kelurahan()
	{
		# code...
		return $this->id_kelurahan;
	}

	public function get_nama_kelurahan()
	{
		# code...
		return $this->nama_kelurahan;
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

	public function get_kecamatan()
	{
		# code...
		return $this->kecamatan;
	}

}