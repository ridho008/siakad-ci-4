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
			'validation' => \Config\Services::validation(),
			'detail' => $detail,
			'matkul' => $this->matkulModel->getWhereIdProdi($id)
			// 'matkul' => $this->matkulModel->joinTable()->get()->getResultArray()
		];
		return view('admin/matkul/detail', $data);
	}

	public function save()
	{
		if(!$this->validate([
			'kode' => [
				'rules' => 'required|is_unique[matkul.kode_matkul]',
				'errors' => [
					'required' => '{field} wajib di isi.',
					'is_unique' => '{field} sudah terdaftar.'
				]
			],
			'matkul' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'sks' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'smt' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			],
			'kategori' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} wajib di isi.'
				]
			]
		])) {
			return redirect()->to('/matkul/detail/' . $this->request->getVar('id_prodi'))->withInput();
		}

		// ambil input smt
		$smt = $this->request->getVar('smt');
		if($smt == 1 || $smt == 3 || $smt == 5 || $smt == 7) {
			$semester = 'Ganjil';
		} else {
			$semester = 'Genap';
		}

		$this->matkulModel->save([
			'kode_matkul' => $this->request->getVar('kode'),
			'matkul' => $this->request->getVar('matkul'),
			'sks' => $this->request->getVar('sks'),
			'kategori' => $this->request->getVar('kategori'),
			'smt' => $this->request->getVar('smt'),
			'semester' => $semester,
			'id_prodi' => $this->request->getVar('id_prodi')
		]);

		session()->setFlashdata('success', 'Data Mata Kuliah Berhasil Ditambahkan.');
		return redirect()->to('/matkul/detail/' . $this->request->getVar('id_prodi'));
	}

	public function destroy($id)
	{
		$this->matkulModel->delete($id);
		session()->setFlashdata('success', 'Data Mata Kuliah Berhasil Dihapus.');
		return redirect()->to('/matkul/detail/' . $this->request->getVar('id_prodi'));
	}

	//--------------------------------------------------------------------

}
