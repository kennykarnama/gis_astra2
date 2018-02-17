<?php

namespace App\AnalisisData;

use App\AnalisisData\Arho;

class Arho {
	
	public $id_arho;

	public $nama_arho;


	public function __construct()
	{
		# code...
	}

	public function set_id_arho($id_arho)
	{
		# code...
		$this->id_arho = $id_arho;
	}

	public function set_nama_arho($nama_arho)
	{
		# code...
		$this->nama_arho = $nama_arho;
	}

	public function get_id_arho()
	{
		# code...
		return $this->id_arho;
	}

	public function get_nama_arho()
	{
		# code...
		return $this->nama_arho;
	}

}