<?php namespace App\Controllers;

use App\Models\JadwalKuliahModel;
use App\Models\TahunAkaModel;
use App\Models\ProdiModel;

class JadwalKuliah extends BaseController
{
	protected $jadwalkuliahModel;
	protected $tahunAkaModel;
	protected $prodiModel;

	public function __construct()
	{
		$this->jadwalkuliahModel = new JadwalKuliahModel();
		$this->tahunAkaModel = new TahunAkaModel();
		$this->prodiModel = new ProdiModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Jadwal Kuliah',
			'validation' => \Config\Services::validation(),
			'tahunAkademik' => $this->jadwalkuliahModel->tahunAktif(),
			'prodi' => $this->prodiModel->joinProdiFakultas()
		];
		return view('admin/jadwal_kuliah/index', $data);
	}

	public function detail($id_prodi)
	{
		$data = [
			'title' => 'Jadwal Kuliah',
			'validation' => \Config\Services::validation(),
			'tahunAkademik' => $this->jadwalkuliahModel->tahunAktif(),
			'jadwal' => $this->jadwalkuliahModel->joinJadwalMatkul($id_prodi),
			'prodi' => $this->prodiModel->joinProdiFakultasWhereId($id_prodi)
		];
		return view('admin/jadwal_kuliah/detail', $data);
	}

	//--------------------------------------------------------------------

}
