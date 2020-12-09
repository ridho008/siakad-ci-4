<?php namespace App\Controllers;

use App\Models\MatkulModel;
use App\Models\ProdiModel;

class Matkul extends BaseController
{
	protected $matkulModel;

	public function __construct()
	{
		$this->matkulModel = new MatkulModel();
		$this->prodiModel = new ProdiModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Mata Kuliah',
			'prodi' => $this->prodiModel->joinProdiFakultas()
			// 'matkul' => $this->matkulModel->joinTable()->get()->getResultArray()
		];
		return view('admin/matkul/index', $data);
	}

	public function detail($id)
	{
		$detail = $this->prodiModel->joinProdiFakultasWhereId($id);
		$data = [
			'title' => 'Detail Mata Kuliah ' . $detail['prodi'],
			'detail' => $detail,
			'matkul' => $this->matkulModel->getWhereIdProdi($id)
			// 'matkul' => $this->matkulModel->joinTable()->get()->getResultArray()
		];
		return view('admin/matkul/detail', $data);
	}

	//--------------------------------------------------------------------

}
